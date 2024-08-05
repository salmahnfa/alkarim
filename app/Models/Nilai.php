<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'ujian_id',
        'deskripsi',
        'guru_quran_id',
        'nilai',
        'tanggal_ujian',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function guruQuran()
    {
        return $this->belongsTo(GuruQuran::class);
    }
}
