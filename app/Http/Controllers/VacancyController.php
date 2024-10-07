<?php

namespace App\Http\Controllers;

use App\Models\Education;
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

    public function submit_applicant(Request $request)
    {
        $data = $request;
        return view('test', compact('data'));
    }

    public function form($id)
    {
        $jobs = Job::findOrFail($id);
        $educations = Education::all();

        return view('vacancy_form', compact('jobs', 'educations'));
    }


    public function test(Request $request)
    {
        $data = $request;
        return view('test', compact('data'));
    }
}
