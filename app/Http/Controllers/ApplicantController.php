<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Education;
use App\Models\Job;
use App\Models\jURUSAN;
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
        $query = Applicant::with('job');
        $jobId = $request->get('job_id');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', '%' . $search . '%');
        }
        if ($request->has('status')) {
            $status = $request->get('status');
            $query->where('status', $status)
                ->where('job_id', $jobId);
        }
        $applicants = $query->get();

        $jobs = Job::all();

        return view('pipelines.index', compact('applicants', 'jobs'));
    }

    public function create()
    {
        $jobs = Job::all();
        $educations = Education::all();
        $jurusans = Jurusan::all();


        return view('pipelines.create', compact('jobs', 'educations', 'jurusans'));
    }

    public function getJurusan($education_id)
    {
        $jurusans = Jurusan::where('education_id', $education_id)->get();
        return response()->json($jurusans);
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
            'certificates' => 'nullable|string',
            'experience_period' => 'nullable|string',
            'photo_pass' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'profile' => 'nullable|string',
            'languages' => 'nullable|string',
            'mbti' => 'nullable|string',
            'iq' => 'nullable|string',
            'achievement' => 'nullable|string',
            'skills' => 'nullable|string',
            'salary_expectation' => 'required|numeric|min:0',



            'role.*' => 'required|string|max:255',
            'desc_kerja.*' => 'required|string',
            'mulai.*' => 'required|date',
            'selesai.*' => 'required|date',

            'project_name.*' => 'nullable|string|max:255',
            'client.*' => 'nullable|string|max:255',
            'desc_project.*' => 'nullable|string',
            'mulai_project.*' => 'nullable|date',
            'selesai_project.*' => 'nullable|date',

            'name_ref.*' => 'required|string|max:255',
            'phone.*' => 'required|string|max:255',
            'email_ref.*' => 'required|string',

            'education' => 'required|exists:education,id', 
            'jurusan' => 'nullable|exists:jurusan,id',    
        ]);

        // Handle file upload for photo_pass if provided
        $path = null;
        if ($request->hasFile('photo_pass')) {
            $path = $request->file('photo_pass')->store('photos', 'public');
        }

        // Create a new applicant
        $applicant = Applicant::create([
            'job_id' => $request->job_id,
            'name' => $request->name,
            'address' => $request->address,
            'number' => $request->number,
            'email' => $request->email,
            'profil_linkedin' => $request->profil_linkedin,
            'certificates' => $request->certificates,
            'experience_period' => $request->experience_period,
            'photo_pass' => $path,
            'profile' => $request->profile,
            'languages' => $request->languages,
            'mbti' => $request->mbti,
            'iq' => $request->iq,
            'achievement' => $request->achievement,
            'skills' => $request->skills,
            'salary_expectation' => $request->salary_expectation,
            'education_id' => $request->education,
            'jurusan_id' => $request->jurusan,
        ]);

        // Handle work experiences
        if ($request->has('role')) {
            foreach ($request->role as $index => $role) {
                $applicant->workExperiences()->create([
                    'role' => $role,
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



    public function edit(Applicant $applicant)
    {
        $jobs = Job::all();
        return view('pipelines.edit', compact('applicant', 'jobs'));
    }

    public function update(Request $request, Applicant $applicant)
    {
        // Validate input
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'number' => 'required|string|max:15',
            'email' => 'required|email',
            'profil_linkedin' => 'nullable|url',
            'certificates' => 'nullable|string',
            'experience_period' => 'nullable|string',
            'photo_pass' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'profile' => 'nullable|string',
            'languages' => 'nullable|string',
            'mbti' => 'nullable|string',
            'iq' => 'nullable|string',
            'achievement' => 'nullable|string',
            'skills' => 'nullable|string',
            'salary_expectation' => 'required|numeric|min:0',
        ]);

        // Handle file upload for photo_pass if provided
        $path = $applicant->photo_pass;
        if ($request->hasFile('photo_pass')) {
            if ($applicant->photo_pass) {
                Storage::disk('public')->delete($applicant->photo_pass);
            }
            $path = $request->file('photo_pass')->store('photos', 'public');
        }

        // Update the applicant
        $applicant->update([
            'job_id' => $request->job_id,
            'name' => $request->name,
            'address' => $request->address,
            'number' => $request->number,
            'email' => $request->email,
            'profil_linkedin' => $request->profil_linkedin,
            'certificates' => $request->certificates,
            'experience_period' => $request->experience_period,
            'photo_pass' => $path,
            'profile' => $request->profile,
            'languages' => $request->languages,
            'mbti' => $request->mbti,
            'iq' => $request->iq,
            'achievement' => $request->achievement,
            'skills' => $request->skills,
            'salary_expectation' => $request->salary_expectation,
        ]);

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
}
