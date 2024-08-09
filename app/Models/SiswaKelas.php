<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'siswa_id',
        'kelas_id',
        'grade',
        'kelompok_halaqah_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function kelompokHalaqah()
    {
        return $this->belongsTo(KelompokHalaqah::class);
    }
}
