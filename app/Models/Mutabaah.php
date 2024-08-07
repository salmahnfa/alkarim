<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutabaah extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'siswa_id',
        'ziyadah',
        'murojaah',
        'tilawah',
        'tahun_ajaran',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
