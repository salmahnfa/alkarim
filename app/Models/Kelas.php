<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'nama',
        'unit_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
