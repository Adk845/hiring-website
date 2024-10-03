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
        'work_location_id', // Corrected from 'work_location'
        'spesifikasi',      // Added 'spesifikasi' as it's part of the schema
        'department',
        'employment_type',
        'minimum_salary',
        'maximum_salary',
        'benefit',
        'responsibilities',
        'requirements',
        'status_published',
    ];

   
    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    // Relasi ke departemen
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'department');
    }

    // Relasi ke lokasi kerja
    public function workLocation()
    {
        return $this->belongsTo(WorkLocation::class, 'work_location_id');
    }
}
