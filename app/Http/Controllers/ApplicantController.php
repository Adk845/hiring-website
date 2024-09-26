<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    // Display a listing of the applicants
    public function index()
{
    // Eager load 'job' relationship for each applicant
    $applicants = Applicant::with('job')->get(); 

    return view('pipelines.index', compact('applicants')); // Return view with applicants and their jobs
}


    // Show the form for creating a new applicant
    public function create()
    {
        $jobs = Job::all(); // Get all jobs for the dropdown
        return view('pipelines.create', compact('jobs')); // Return create view with jobs
    }

    // Store a newly created applicant in storage
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
            'portfolio' => 'nullable|url',
            'certificates' => 'nullable|string',
            'education' => 'nullable|string',
            'experience' => 'nullable|string',
            'photo_pass' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate image
            'profile' => 'nullable|string',
            'languages' => 'nullable|string',
            'skills' => 'nullable|string',
            'salary_expectation' => 'required|numeric|min:0',
        ]);

        // Handle file upload for photo_pass if provided
        $path = null;
        if ($request->hasFile('photo_pass')) {
            $path = $request->file('photo_pass')->store('photos', 'public'); // Store file in the 'photos' directory
        }

        // Create a new applicant
        Applicant::create([
            'job_id' => $request->job_id,
            'name' => $request->name,
            'address' => $request->address,
            'number' => $request->number,
            'email' => $request->email,
            'profil_linkedin' => $request->profil_linkedin,
            'portfolio' => $request->portfolio,
            'certificates' => $request->certificates,
            'education' => $request->education,
            'experience' => $request->experience,
            'photo_pass' => $path,
            'profile' => $request->profile,
            'languages' => $request->languages,
            'skills' => $request->skills,
            'salary_expectation' => $request->salary_expectation,
        ]);

        return redirect()->route('pipelines.index')->with('success', 'Applicant created successfully.'); // Redirect with success message
    }

    // Show the form for editing the specified applicant
    public function edit(Applicant $applicant)
    {
        $jobs = Job::all(); // Get all jobs for the dropdown
        return view('pipelines.edit', compact('applicant', 'jobs')); // Return edit view with applicant and jobs
    }

    // Update the specified applicant in storage
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
            'portfolio' => 'nullable|url',
            'certificates' => 'nullable|string',
            'education' => 'nullable|string',
            'experience' => 'nullable|string',
            'photo_pass' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'profile' => 'nullable|string',
            'languages' => 'nullable|string',
            'skills' => 'nullable|string',
            'salary_expectation' => 'required|numeric|min:0',
        ]);

        // Handle file upload for photo_pass if provided
        $path = $applicant->photo_pass; // Keep the existing photo if none is uploaded
        if ($request->hasFile('photo_pass')) {
            // Delete the old photo if it exists
            if ($applicant->photo_pass) {
                Storage::disk('public')->delete($applicant->photo_pass);
            }
            // Store the new file
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
            'portfolio' => $request->portfolio,
            'certificates' => $request->certificates,
            'education' => $request->education,
            'experience' => $request->experience,
            'photo_pass' => $path,
            'profile' => $request->profile,
            'languages' => $request->languages,
            'skills' => $request->skills,
            'salary_expectation' => $request->salary_expectation,
        ]);

        return redirect()->route('pipelines.index')->with('success', 'Applicant updated successfully.'); // Redirect with success message
    }

    // Remove the specified applicant from storage
    public function destroy($id)
    {
        //Menghapus department
        $applicant = Applicant::find($id);

        if ($applicant) $applicant->delete();
        return redirect()->route('pipelines.index')->with('success_message', 'Berhasil menghapus department');
    }

}
