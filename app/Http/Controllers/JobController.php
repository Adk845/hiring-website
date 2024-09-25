<?php

namespace App\Http\Controllers;

use App\Models\Job as ModelsJob;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;


class JobController extends Controller
{
   
    public function index()
    {
        // Mengambil semua data jobs
        $jobs = ModelsJob:: all();
        
        // Mengirim data jobs ke view 'jobs.index'
        return view('jobs.index', ['jobs' => $jobs]);
    }
    



    public function create()
    {
        return view('jobs.create');
    }

    // Menyimpan data job baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'job_name' => 'required|string|max:255',
            'work_location' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'employment_type' => 'required|string',
            'minimum_salary' => 'required|numeric',
            'maximum_salary' => 'required|numeric',
            'benefit' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'status_published' => 'required|boolean',
        ]);

        // Menyimpan job baru
        ModelsJob::create($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    // Menampilkan form edit untuk job
    public function edit($id)
    {
        $job = ModelsJob::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    // Memperbarui data job di database
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'job_name' => 'required|string|max:255',
            'work_location' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'employment_type' => 'required|string',
            'minimum_salary' => 'required|numeric',
            'maximum_salary' => 'required|numeric',
            'benefit' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'status_published' => 'required|boolean',
        ]);

        // Memperbarui job
        $job = ModelsJob::findOrFail($id);
        $job->update($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }


// public function updateStatus(Request $request, Job $job)
// {
//     $request->validate([
//         'status_published' => 'required|boolean',
//     ]);

//     $job->status_published = $request->status_published;
//     $job->save();

//     return redirect()->route('jobs.index')->with('success', 'Status updated successfully.');
// }

}
