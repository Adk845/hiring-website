<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Job as ModelsJob;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;


class JobController extends Controller
{
   
    public function index(Request $request)
    {
        $query = ModelsJob::query();
        
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('job_name', 'like', '%' . $search . '%')
                  ->orWhere('work_location', 'like', '%' . $search . '%');
        }
    
        $jobs = $query->get();
        
        return view('jobs.index', compact('jobs'));
    }



    public function create()
    {
        // Mengambil semua departemen dari database
        $departements = Departement::all();
        
        // Mengirim data departemen ke view create
        return view('jobs.create', compact('departements'));
    }

    // Menyimpan data job baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'job_name' => 'required|string|max:255',
            'work_location' => 'required|string|max:255',
            'department' => 'required|exists:departements,id', // Pastikan ini menggunakan ID
            'employment_type' => 'required|string',
            'minimum_salary' => 'required|numeric',
            'maximum_salary' => 'required|numeric',
            'benefit' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            // 'status_published' => 'required|boolean',
        ]);

        // Menyimpan job baru
        ModelsJob::create($request->all());
        // ModelsJob::create(array_merge($request->all(), ['status_published' => 'unpublished']));

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    // Menampilkan form edit untuk job
    public function edit($id)
    {
        // Fetch the job by ID
        $job = ModelsJob::findOrFail($id);
        // Fetch all departments
        $departements = Departement::all();
    
        // Return the edit view with job and departments
        return view('jobs.edit', compact('job', 'departements'));
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

public function destroy($id)
    {
        //Menghapus department
        $job = ModelsJob::find($id);

        if ($job) $job->delete();
        return redirect()->route('jobs.index')->with('success_message', 'Berhasil menghapus department');
    }

}
