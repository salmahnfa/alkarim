<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'nama',
        'unit_id',
        'kelas_id',
        'grade',
        'kelompok_halaqah_id',
        'surah_id',
        'jilid_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function kelompokHalaqah()
    {
        return $this->hasMany(KelompokHalaqah::class);
    }

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }

    public function jilid()
    {
        return $this->belongsTo(Jilid::class);
    }
}
