<?php

namespace App\Http\Controllers;

use App\DataTables\NilaisDataTable;
use App\Models\GuruQuran;
use App\Models\Kelas;
use App\Models\Ujian;
use App\Models\Unit;
use Illuminate\Support\Facades\Date;

class RekapNilaiController extends Controller
{
    public function rekap_nilai(NilaisDataTable $dataTable)
    {
        $yearNow = Date::now()->year;
        $tahun_ajaran = $yearNow . "/" . $yearNow + 1;

        $units = Unit::select('id', 'nama')->orderBy('nama')->get();
        $ujians = Ujian::select('id', 'nama')->orderBy('nama')->get();
        $gurus = GuruQuran::join('users', 'users.id', 'guru_qurans.user_id')
            ->select('guru_qurans.id', 'guru_qurans.unit_id', 'users.nama')->orderBy('nama')->get();
        $kelas = Kelas::select('id', 'unit_id', 'nama')->orderBy('unit_id')->orderBy('nama')->get();

        $data = [
            'title' => 'Rekap Nilai',
            'page_title' => 'Rekap Nilai',
            'tahun_ajaran' => $tahun_ajaran,
            'units' => $units,
            'ujians' => $ujians,
            'gurus' => $gurus,
            'kelas' => $kelas,
        ];

        return $dataTable->with('tahun_ajaran', $tahun_ajaran)->render('contents.components.rekap_nilai', $data);
    }
}
