<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jilid extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'jml_hal',
        'file_path',
    ];
}
