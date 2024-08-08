<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruQuran extends Model
{
    protected $fillable = [
        'user_id',
        'unit_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'guru_quran_id', 'id');
    }

    public function kelompokHalaqahs()
    {
        return $this->hasMany(KelompokHalaqah::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
