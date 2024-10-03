<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'education';

    protected $fillable = [
        'name_education',
        'applicant_id', // Ensure this is included
    ];

    public function jurusan()
{
    return $this->hasMany(Jurusan::class);
}

}
