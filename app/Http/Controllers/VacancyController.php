<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class VacancyController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel jobs
        $jobs = Job::all();
        
        // Kirim data jobs ke view vacancy
        return view('vacancy', compact('jobs'));
    }
}
