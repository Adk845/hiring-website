<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Education;
use App\Models\Job;
use App\Models\jURUSAN;
use App\Models\Project;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ApplicantController extends Controller
{
    public function generatePdf($id)
    {
        $applicant = Applicant::find($id);

        if (!$applicant) {
            return redirect()->route('pipelines.index')->with('error', 'Applicant not found.');
        }

        $pdf = PDF::loadView('pipelines.pdf', ['applicant' => $applicant])
            ->setPaper('a4', 'portrait');

        return $pdf->stream('applicant-cv-' . $applicant->name . '.pdf');
    }


    public function index(Request $request)
    {
        $query = Applicant::with('job', 'education', 'jurusan');
    
        $jobId = $request->get('job_id');
        
        // Get job title only if job ID is provided
        $jobTitle = $jobId ? optional(Job::find($jobId))->job_name : null;
    
        if ($jobId) {
            $query->where('job_id', $jobId);
        }
    
        // Retrieve the current status filter if it exists
        $currentStatus = $request->get('status');
    
        // Change 'stage' to 'status'
        if ($currentStatus && $currentStatus !== '') {
            $query->where('status', $currentStatus);
        }
    
        // Get the count of applicants based on status
        $statusCounts = [
            'applied' => Applicant::where('status', 'applied')->count(),
            'interview' => Applicant::where('status', 'interview')->count(),
            'offer' => Applicant::where('status', 'offer')->count(),
            'accepted' => Applicant::where('status', 'accepted')->count(),
        ];
    
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        // Additional filtering logic for education and jurusan
        if (!$request->has('status')) {
            if ($request->has('education') && !empty($request->get('education'))) {
                $educationId = $request->get('education');
                $query->where('education_id', $educationId);
            }
    
            if ($request->has('jurusan') && !empty($request->get('jurusan'))) {
                $jurusanId = $request->get('jurusan');
                $query->where('jurusan_id', $jurusanId);
            }
        }
    
        $applicants = $query->get();
    
        // Get the stage name only if a job ID is provided
        $stageName = $jobId && $applicants->isNotEmpty() ? $applicants->first()->status : null;
    
        $jobs = Job::all();
        $educations = Education::all();
        $jurusans = Jurusan::all();
    
        return view('pipelines.index', compact('applicants', 'jobs', 'jobTitle', 'educations', 'jurusans', 'request', 'statusCounts', 'stageName'));
    }
    
    






    public function getJurusan($education_id)
    {
        $jurusans = Jurusan::where('education_id', $education_id)->get();
        return response()->json($jurusans);
    }

    public function create()
    {
        $jobs = Job::all();
        $educations = Education::all();
        $jurusans = Jurusan::all();


        return view('pipelines.create', compact('jobs', 'educations', 'jurusans'));
    }




    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'number' => 'required|string|max:15',
            'email' => 'required|email',
            'profil_linkedin' => 'nullable|url',
            'certificates.*' => 'nullable|string',
            'experience_period' => 'nullable|string',
            'photo_pass' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'profile' => 'nullable|string',
            'languages' => 'nullable|string',
            'mbti' => 'nullable|string',
            'iq' => 'nullable|string',
            'achievement.*' => 'nullable|string',
            'skills.*' => 'nullable|string',
            'salary_expectation' => 'required|numeric|min:0',



            'role.*' => 'required|string|max:255',
            'name_company.*' => 'required|string',
            'desc_kerja.*' => 'required|string',
            'mulai.*' => 'required|date',
            'selesai.*' => 'required|date',

            'project_name.*' => 'nullable|string|max:255',
            'client.*' => 'nullable|string|max:255',
            'desc_project.*' => 'nullable|string',
            'mulai_project.*' => 'nullable|date',
            'selesai_project.*' => 'nullable|date',

            'name_ref.*' => 'nullable|string|max:255',
            'phone.*' => 'nullable|string|max:255',
            'email_ref.*' => 'nullable|string',

            'education' => 'required|exists:education,id',
            'jurusan' => 'nullable|exists:jurusan,id',
        ]);

        // Handle file upload for photo_pass if provided
        $path = null;
        if ($request->hasFile('photo_pass')) {
            $path = $request->file('photo_pass')->store('photos', 'public');
        }
        $applicant = Applicant::create([
            'job_id' => $request->job_id,
            'name' => $request->name,
            'address' => $request->address,
            'number' => $request->number,
            'email' => $request->email,
            'profil_linkedin' => $request->profil_linkedin,
            'certificates' => implode("|", $request->certificates),
            'experience_period' => $request->experience_period,
            'photo_pass' => $path,
            'profile' => $request->profile,
            'languages' => $request->languages,
            'mbti' => $request->mbti,
            'iq' => $request->iq,
            'achievement' => implode("|", $request->achievements),
            'skills' => implode("|", $request->skills),
            'salary_expectation' => $request->salary_expectation,
            'education_id' => $request->education,
            'jurusan_id' => $request->jurusan,
        ]);

        // Handle work experiences
        if ($request->has('role')) {
            foreach ($request->role as $index => $role) {
                $applicant->workExperiences()->create([
                    'role' => $role,
                    'name_company' => $request->name_company[$index],
                    'desc_kerja' => $request->desc_kerja[$index],
                    'mulai' => $request->mulai[$index],
                    'selesai' => $request->selesai[$index],
                ]);
            }
        }

        // Handle projects
        if ($request->has('project_name')) {
            foreach ($request->project_name as $index => $project_name) {
                $applicant->projects()->create([
                    'project_name' => $project_name,
                    'desc_project' => $request->desc_project[$index],
                    'client' => $request->client[$index],
                    'mulai_project' => $request->mulai_project[$index],
                    'selesai_project' => $request->selesai_project[$index],
                ]);
            }
        }

        if ($request->has('name_ref')) {
            foreach ($request->name_ref as $index => $name_ref) {
                $applicant->references()->create([
                    'name_ref' => $name_ref,
                    'phone' => $request->phone[$index],
                    'email_ref' => $request->email_ref[$index],
                ]);
            }
        }




        return redirect()->route('pipelines.index')->with('success', 'Applicant created successfully.');
    }


    public function edit($id)
    {
        $applicant = Applicant::with(['workExperiences', 'projects', 'references'])->findOrFail($id);
        $jobs = Job::all();
        $educations = Education::all();
        $jurusans = Jurusan::where('education_id', $applicant->education_id)->get();
        $references = Reference::all();
        $project = Project::all();



        return view('pipelines.edit', compact('applicant', 'jobs', 'educations', 'jurusans'));
    }

    public function edit_api($id)
    {
        $applicant = Applicant::with(['workExperiences', 'projects', 'references'])->findOrFail($id);
        $jobs = Job::all();
        $educations = Education::all();
        $jurusans = Jurusan::where('education_id', $applicant->education_id)->get();

        return json_encode($applicant);
    }

    public function update(Request $request, $id)
    {

        
        // Validate input
        //khusus validate yang sifatnya array maka harus ditambahkan '.*' setelah nama atribut $requestnya 
        //misal 'skills.*' => 'nullable|string',
        //kalau gak dia bakal refresh refresh terus di form dan gak kemana mana 
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'number' => 'required|string|max:15',
            'email' => 'required|email',
            'profil_linkedin' => 'nullable|url',
            'certificates.*' => 'nullable|string',
            'experience_period' => 'nullable|string',
            'photo_pass' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'profile' => 'nullable|string',
            'languages' => 'nullable|string',
            'mbti' => 'nullable|string',
            'iq' => 'nullable|string',
            'achievement.*' => 'nullable|string',
            'skills.*' => 'nullable|string',
            'salary_expectation' => 'required|numeric|min:0',

            'role.*' => 'required|string|max:255',
            'desc_kerja.*' => 'required|string',
            'name_company.*' => 'required|string',
            'mulai.*' => 'required|date',
            'selesai.*' => 'required|date',

            'project_name.*' => 'nullable|string|max:255',
            'client.*' => 'nullable|string|max:255',
            'desc_project.*' => 'nullable|string',
            'mulai_project.*' => 'nullable|date',
            'selesai_project.*' => 'nullable|date',

            'name_ref.*' => 'nullable|string|max:255',
            'phone.*' => 'nullable|string|max:255',
            'email_ref.*' => 'nullable|string',

            'education' => 'required|exists:education,id',
            'jurusan' => 'nullable|exists:jurusan,id',
        ]);
        
        // Retrieve the applicant
        $applicant = Applicant::findOrFail($id);

        // Handle file upload for photo_pass if provided
        if ($request->hasFile('photo_pass')) {
            $path = $request->file('photo_pass')->store('photos', 'public');
            $applicant->update(['photo_pass' => $path]);
        }

        // Update applicant data
        $applicant->update([
            'job_id' => $request->job_id,
            'name' => $request->name,
            'address' => $request->address,
            'number' => $request->number,
            'email' => $request->email,
            'profil_linkedin' => $request->profil_linkedin,
            'certificates' => implode("|", $request->certificates),
            'experience_period' => $request->experience_period,
            'profile' => $request->profile,
            'languages' => $request->languages,
            'mbti' => $request->mbti,
            'iq' => $request->iq,
            'achievement' => implode("|", $request->achievements),
            'skills' => implode("|", $request->skills),
            'salary_expectation' => $request->salary_expectation,
            'education_id' => $request->education,
            'jurusan_id' => $request->jurusan,
        ]);

        // Update or create work experiences
        $applicant->workExperiences()->delete(); // Delete previous work experiences
        if ($request->has('role')) {
            foreach ($request->role as $index => $role) {
                $applicant->workExperiences()->create([
                    'role' => $role,
                    'desc_kerja' => $request->desc_kerja[$index],
                    'name_company' => $request->name_company[$index],
                    'mulai' => $request->mulai[$index],
                    'selesai' => $request->selesai[$index],
                ]);
            }
        }

        // Update or create projects
        $applicant->projects()->delete(); // Delete previous projects
        if ($request->has('project_name')) {
            foreach ($request->project_name as $index => $project_name) {
                $applicant->projects()->create([
                    'project_name' => $project_name,
                    'desc_project' => $request->desc_project[$index],
                    'client' => $request->client[$index],
                    'mulai_project' => $request->mulai_project[$index],
                    'selesai_project' => $request->selesai_project[$index],
                ]);
            }
        }

        // Update or create references
        $applicant->references()->delete(); // Delete previous references
        if ($request->has('name_ref')) {
            foreach ($request->name_ref as $index => $name_ref) {
                $applicant->references()->create([
                    'name_ref' => $name_ref,
                    'phone' => $request->phone[$index],
                    'email_ref' => $request->email_ref[$index],
                ]);
            }
        }

        return redirect()->route('pipelines.index')->with('success', 'Applicant updated successfully.');
    }


    public function destroy($id)
    {
        $applicant = Applicant::find($id);
        if ($applicant) $applicant->delete();
        return redirect()->route('pipelines.index')->with('success_message', 'Applicant deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $applicant = Applicant::findOrFail($id);
        $applicant->status = $request->status;
        $applicant->save();

        return redirect()->back()->with('success', 'Applicant status updated successfully!');
    }

    public function show($jobId)
    {
        // Get the job title
        $job = Job::find($jobId);
        $jobTitle = $job ? $job->job_name : null;
    
        // Get applicants for this job
        $applicants = Applicant::where('job_id', $jobId)->get();
    
        // Get the stage name for the first applicant (or however you want to decide)
        $stageName = $applicants->isNotEmpty() ? $applicants->first()->status : null;
    
        return view('jobs.show', compact('applicants', 'jobTitle', 'stageName'));
    }
    
}
