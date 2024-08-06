<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'nama',
        'surah_id',
        'jilid_id',
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'siswa_kelas');
    }

    public function latestKelas(): HasOne
{
    return $this->hasOne(Kelas::class)->latestOfMany();
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

    public function guruQuran()
    {
        return $this->belongsTo(GuruQuran::class);
    }
}
