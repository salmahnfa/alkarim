<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GuruQuran;
use App\Models\Nilai;

class PPQController extends Controller
{
    public function dashboard()
    {
        $data = [
            'title' => 'Pengembangan Pembelajaran Quran'
        ];

        return view('ppq.dashboard', $data);
    }

    public function kelompok_halaqah()
    {
        $guru_qurans = GuruQuran::with('siswa')->get();

        $data = [
            'guru_qurans' => $guru_qurans,
            'title' => 'Kelompok Halaqah',
            'page_title' => 'Kelompok Halaqah'
        ];

        return view('ppq.kelompok_halaqah', $data);
    }

    public function rekap_nilai()
    {
        $nilais = Nilai::with('siswa.guruQuran')->get();

        $data = [
            'nilais' => $nilais,
            'title' => 'Rekap Nilai',
            'page_title' => 'Rekap Nilai'
        ];

        return view('ppq.rekap_nilai', $data);
    }
}
