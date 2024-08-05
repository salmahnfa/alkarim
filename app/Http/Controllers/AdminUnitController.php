<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GuruQuran;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\KelompokHalaqah;

class AdminUnitController extends Controller
{
    public function dashboard()
    {
        $data = [
            'title' => 'Administrator Unit'
        ];

        return view('admin_unit.dashboard', $data);
    }

    public function kelompok_halaqah()
    {
        $adminUnit = auth()->user()->adminUnit;
        $unitId = $adminUnit->unit_id;

        $kelompokHalaqahs = KelompokHalaqah::where('unit_id', $unitId)->get();
        $guruQurans = GuruQuran::where('unit_id', $unitId)->get();
        $siswas = Siswa::where('unit_id', $unitId)->get();
        $users = User::all();

        $data = [
            'kelompokHalaqahs' => $kelompokHalaqahs,
            'guruQurans' => $guruQurans,
            'siswas' => $siswas,
            'users' => $users,
            'title' => 'Kelompok Halaqah',
            'page_title' => 'Kelompok Halaqah'
        ];

        return view('admin_unit.kelompok_halaqah', $data);
    }

    public function rekap_nilai()
    {
        $unitId = auth()->user()->adminUnit->unit_id;
        $siswaId = Siswa::where('unit_id', $unitId)->pluck('id');
        
        $nilais = Nilai::whereIn('siswa_id', $siswaId)->get();

        $data = [
            'nilais' => $nilais,
            'title' => 'Rekap Nilai',
            'page_title' => 'Rekap Nilai'
        ];

        return view('admin_unit.rekap_nilai', $data);
    }
}
