<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan (opsional, jika berbeda dengan default plural)
    protected $table = 'jobs';

    // Kolom yang bisa diisi secara massal (mass assignment)
    protected $fillable = [
        'job_name',
        'work_location',
        'department',
        'employment_type',
        'minimum_salary',
        'maximum_salary',
        'benefit',
        'responsibilities',
        'requirements',
        'status_published',
    ];

    // Relasi ke model lain, jika ada
    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
}


