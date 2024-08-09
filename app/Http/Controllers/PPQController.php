<?php

namespace App\Http\Controllers;

use App\DataTables\KelompokHalaqahsDataTable;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GuruQuran;
use App\Models\Nilai;
use App\Models\Unit;
use Illuminate\Support\Facades\Date;

class PPQController extends Controller
{
    public function dashboard()
    {
        $data = [
            'title' => 'Pengembangan Pembelajaran Quran'
        ];

        return view('ppq.dashboard', $data);
    }

    public function kelompok_halaqah(Request $request, KelompokHalaqahsDataTable $dataTable)
    {
        $yearNow = Date::now()->year;
        $tahun_ajaran = $yearNow . "/" . $yearNow + 1;

        $units = Unit::select('id', 'nama')->orderBy('nama')->get();

        $data = [
            'units' => $units,
            'title' => 'Kelompok Halaqah',
            'page_title' => 'Kelompok Halaqah',
            'tahun_ajaran' => $tahun_ajaran
        ];

        return $dataTable->with('tahun_ajaran', $tahun_ajaran)->render('contents.components.kelompok_halaqah', $data);
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
