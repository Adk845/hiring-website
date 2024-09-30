<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class VacancyController extends Controller
{
    public function index($id)
    {
        // cari jobs dengan id tertentu
        $jobs = Job::findOrfail($id);
        
        // Kirim data jobs ke view vacancy
        return view('vacancy', compact('jobs'));
    }

    public function list()
    {
        $jobs = Job::all();
        return view('vacancy_list', compact('jobs'));
    }
}
