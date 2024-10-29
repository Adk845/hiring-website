<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Applicant;

class VacancyController extends Controller
{
    public function index($id)
    {
        // cari jobs dengan id tertentu
        $jobs = Job::findOrfail($id);
        $work_location = $jobs->workLocation->location; 
        //diatas adalah contoh dari inverse relation child referensi ke parent, kita harus sesuaikan dengan nama model nya
        //nama table nya adalah work_location, tapi nama model nya adalah WorkLocation 
        //maka kita pakai WorkLocation
        if(!$jobs || $jobs->status_published == 0){
            abort(404);
        }
        
        // Kirim data jobs ke view vacancy
        return view('vacancy', compact('jobs', 'work_location'));
    }


    public function list()
    {
        $jobs = Job::all();
        $jobs = Job::where('status_published', 1)->get();
        return view('vacancy_list', compact('jobs'));
    }

    public function submit_applicant(Request $request)
    {
        $data = $request;
        return view('test', compact('data'));
    }

    public function form($id)
    {
        $jobs = Job::findOrFail($id);
        $educations = Education::all();

        if(!$jobs || $jobs->status_published == 0){
            abort(404);
        }

        return view('vacancy_form', compact('jobs', 'educations'));
    }

    public function kirim(Request $request)
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


        return redirect()->route('vacancy', $request->job_id)->with('success', 'your Application has been sent');
    }

    

    public function test(Request $request)
    {
        $data = $request;
        return view('test', compact('data'));
    }
}
