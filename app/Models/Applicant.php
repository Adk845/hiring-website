<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'name',
        'address',
        'number',
        'email',
        'profil_linkedin',
        'portfolio',
        'certificates',
        'education',
        'experience',
        'photo_pass',
        'profile',
        'languages',
        'skills',
        'salary_expectation',
        'status',
    ];

    // Define the relationship with the Job model
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
