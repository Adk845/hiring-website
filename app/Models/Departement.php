<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'departements';

    // Kolom yang boleh diisi (mass-assignable)
    protected $fillable = ['dep_name'];

    // Tambahkan relasi jika diperlukan di sini. Misalnya, jika Departement punya relasi dengan User:
    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
