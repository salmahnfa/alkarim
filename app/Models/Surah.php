<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    protected $fillable = [
        'nama',
        'nama_arab',
        'arti',
        'tipe',
        'jml_ayat',
        'durasi',
        'file_path',
    ];
}
