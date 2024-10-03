<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\WorkLocation;
use App\Models\Job as ModelsJob;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Display all jobs or filter by department
    public function index(Request $request)
    {
        $departmentId = $request->get('department');

        // Filter by department if it's provided, otherwise show all jobs
        if ($departmentId) {
            $jobs = ModelsJob::where('department', $departmentId)->get();
        } else {
            $jobs = ModelsJob::all(); 
        }
        
        return view('jobs.index', compact('jobs'));
    }

    // Show the form for creating a new job
    public function create()
    {
        $departements = Departement::all(); // Fetch all departments
        $workLocations = WorkLocation::all(); // Fetch all work locations
        
        return view('jobs.create', compact('departements', 'workLocations'));
    }

    // Store a new job in the database
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'job_name' => 'required|string|max:255',
            'work_location_id' => 'required|exists:work_location,id', // Validate that work_location_id exists
            'department' => 'required|exists:departements,id',
            'employment_type' => 'required|string',
            'minimum_salary' => 'required|numeric',
            'maximum_salary' => 'required|numeric',
            'benefit' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
        ]);
    
        // dd($request->all()); // This will dump the request data and halt execution
        ModelsJob::create($request->all());
        
    
        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }
    
    // Show the form to edit an existing job
    public function edit($id)
    {
        $job = ModelsJob::findOrFail($id); // Fetch the job by ID
        $departements = Departement::all(); // Fetch all departments
        $workLocations = WorkLocation::all(); // Fetch all work locations
    
        return view('jobs.edit', compact('job', 'departements', 'workLocations'));
    }
    
    // Update the job in the database
    public function update(Request $request, $id)
    {
        // Validate the request input based on your database schema
        $request->validate([
            'job_name' => 'required|string|max:255',
            'work_location_id' => 'required|exists:work_location,id',
            'spesifikasi' => 'nullable|string',
            'department' => 'required|exists:departements,id', // Make sure department exists
            'employment_type' => 'required|string',
            'minimum_salary' => 'required|numeric',
            'maximum_salary' => 'required|numeric',
            'benefit' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'status_published' => 'required|boolean',
        ]);

        // Update the job record
        $job = ModelsJob::findOrFail($id);
        $job->update($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    // Delete a job from the database
    public function destroy($id)
    {
        // Find and delete the job
        $job = ModelsJob::find($id);

        if ($job) $job->delete();
        return redirect()->route('jobs.index')->with('success_message', 'Job deleted successfully.');
    }
}
