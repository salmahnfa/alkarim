<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Mutabaah;
use App\Models\Ujian;

class GuruQuranController extends Controller
{
    public function dashboard()
    {
        $data = [
            'title' => 'Guru Quran'
        ];

        return view('guru_quran.dashboard', $data);
    }

    public function kelompok_halaqah()
    {
        $guruQuran = auth()->user()->guruQuran;

        $kelompokHalaqahs = $guruQuran->kelompokHalaqahs()->get();
        $siswas = Siswa::whereIn('kelompok_halaqah_id', $kelompokHalaqahs->pluck('id'))->get();

        $data = [
            'siswas' => $siswas,
            'kelompokHalaqahs' => $kelompokHalaqahs,
            'title' => 'Kelompok Halaqah',
            'page_title' => 'Kelompok Halaqah'
        ];

        return view('guru_quran.kelompok_halaqah', $data);
    }

    public function mutabaah()
    {
        $guruQuran = auth()->user()->guruQuran;
        
        $kelompokHalaqahs = $guruQuran->kelompokHalaqahs()->get();
        $mutabaahs = Mutabaah::whereIn('siswa_id', Siswa::whereIn('kelompok_halaqah_id', $kelompokHalaqahs->pluck('id'))->pluck('id'))->get();

        $data = [
            'mutabaahs' => $mutabaahs,
            'kelompokHalaqahs' => $kelompokHalaqahs,
            'title' => 'Mutabaah',
            'page_title' => 'Mutabaah Siswa'
        ];

        return view('guru_quran.mutabaah', $data);
    }

    public function nilai()
    {
        $guruQuran = auth()->user()->guruQuran;
        
        $kelompokHalaqahs = $guruQuran->kelompokHalaqahs()->get();
        $nilais = Nilai::whereIn('siswa_id', Siswa::whereIn('kelompok_halaqah_id', $kelompokHalaqahs->pluck('id'))->pluck('id'))->get();
        
        $ujians = Ujian::all();

        $data = [
            'kelompokHalaqahs' => $kelompokHalaqahs,
            'nilais' => $nilais,
            'ujians' => $ujians,
            'title' => 'Kelompok Halaqah',
            'page_title' => 'Kelompok Halaqah'
        ];

        return view('guru_quran.nilai', $data);
    }

    public function tahsin()
    {
        $guruQuranId = auth()->user()->guruQuran->id;
        $siswas = Siswa::where('guru_quran_id', $guruQuranId)->get();

        $nilais = Nilai::whereIn('siswa_id', $siswas->pluck('id'))->where('ujian_id', 1)->get();

        $data = [
            'nilais' => $nilais,
            'siswas' => $siswas,
            'title' => 'Tahsin',
            'page_title' => 'Nilai Ujian Tahsin'
        ];

        return view('guru_quran.nilais.tahsin', $data);
    }

    public function tasmi()
    {
        $guruQuranId = auth()->user()->guruQuran->id;
        $siswas = Siswa::where('guru_quran_id', $guruQuranId)->get();

        $nilais = Nilai::whereIn('siswa_id', $siswas->pluck('id'))->where('ujian_id', 2)->get();

        $data = [
            'nilais' => $nilais,
            'siswas' => $siswas,
            'title' => 'Tasmi',
            'page_title' => 'Nilai Ujian Tasmi'
        ];

        return view('guru_quran.nilais.tasmi', $data);
    }

    public function tahfidz()
    {
        $guruQuranId = auth()->user()->guruQuran->id;
        $siswas = Siswa::where('guru_quran_id', $guruQuranId)->get();

        $nilais = Nilai::whereIn('siswa_id', $siswas->pluck('id'))->where('ujian_id', 2)->get();

        $data = [
            'nilais' => $nilais,
            'siswas' => $siswas,
            'title' => 'Tahfidz',
            'page_title' => 'Nilai Ujian Tahfidz'
        ];

        return view('guru_quran.nilais.tahfidz', $data);
    }
}