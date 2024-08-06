<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokHalaqah extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'kelas_id',
        'grade',
        'guru_quran_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guruQuran()
    {
        return $this->belongsTo(GuruQuran::class);
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_kelas');
    }
}
