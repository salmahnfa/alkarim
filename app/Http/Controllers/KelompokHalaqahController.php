<?php

namespace App\Http\Controllers;

use App\DataTables\KelompokHalaqahsDataTable;
use App\Models\GuruQuran;
use App\Models\Kelas;
use App\Models\Unit;
use Illuminate\Support\Facades\Date;

class KelompokHalaqahController extends Controller
{
    public function kelompok_halaqah(KelompokHalaqahsDataTable $dataTable)
    {
        $yearNow = Date::now()->year;
        $tahun_ajaran = $yearNow . "/" . $yearNow + 1;

        $units = Unit::select('id', 'nama')->orderBy('nama')->get();
        $gurus = GuruQuran::join('users', 'users.id', 'guru_qurans.user_id')
            ->select('guru_qurans.id', 'guru_qurans.unit_id', 'users.nama')->orderBy('nama')->get();
        $kelas = Kelas::select('id', 'unit_id', 'nama')->orderBy('unit_id')->orderBy('nama')->get();


        $data = [
            'title' => 'Kelompok Halaqah',
            'page_title' => 'Kelompok Halaqah',
            'tahun_ajaran' => $tahun_ajaran,
            'units' => $units,
            'gurus' => $gurus,
            'kelas' => $kelas,
        ];

        return $dataTable->with('tahun_ajaran', $tahun_ajaran)->render('contents.components.kelompok_halaqah', $data);
    }
}
