<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ujian;
use App\Models\GuruQuran;
use App\Models\KelompokHalaqah;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Support\Facades\Date;

class AdminPusatController extends Controller
{
    public function dashboard()
    {
        $data = [
            'title' => 'Administrator Pusat',
            'page_title' => 'Administrator Unit'
        ];

        return view('admin_pusat.dashboard', $data);
    }

    public function admin_pusat()
    {
        $users = User::where('role_id', 1)->get();

        $data = [
            'users' => $users,
            'title' => 'Administrator Pusat',
            'page_title' => 'Administrator Pusat'
        ];

        return view('admin_pusat.users.admin_pusat', $data);
    }

    public function ppq()
    {
        $users = User::where('role_id', 2)->get();

        $data = [
            'users' => $users,
            'title' => 'Administrator Unit',
            'page_title' => 'Administrator Unit'
        ];

        return view('admin_pusat.users.ppq', $data);
    }

    public function admin_unit()
    {
        $users = User::where('role_id', 3)->get();

        $data = [
            'users' => $users,
            'title' => 'Administrator Unit',
            'page_title' => 'Administrator Unit'
        ];

        return view('admin_pusat.users.admin_unit', $data);
    }

    public function guru_quran()
    {
        $users = User::where('role_id', 4)->get();

        $data = [
            'users' => $users,
            'title' => 'Guru Quran',
            'page_title' => 'Guru Quran'
        ];

        return view('admin_pusat.users.guru_quran', $data);
    }

    public function kelompok_halaqah(?string $tahun_ajaran_start = null, ?string $tahun_ajaran_end = null)
    {
        if (!$tahun_ajaran_start) {
            $yearNow = Date::now()->year;
            $tahun_ajaran = $yearNow . "/" . $yearNow + 1;
        } else {
            $tahun_ajaran = "$tahun_ajaran_start/$tahun_ajaran_end";
        }

        $guru_qurans = GuruQuran::with(['kelompokHalaqahs.siswas' => function ($query) use ($tahun_ajaran) {
            $query->wherePivot('tahun_ajaran', $tahun_ajaran);
        }])->with('kelompokHalaqahs.kelas')->get();

        $data = [
            'guru_qurans' => $guru_qurans,
            'title' => 'Kelompok Halaqah',
            'page_title' => 'Kelompok Halaqah',
            'tahun_ajaran' => $tahun_ajaran
        ];

        return view('admin_pusat.kelompok_halaqah', $data);
    }

    public function rekap_nilai()
    {
        $nilais = Nilai::with('siswa.guruQuran')->get();

        $data = [
            'nilais' => $nilais,
            'title' => 'Rekap Nilai',
            'page_title' => 'Rekap Nilai'
        ];

        return view('admin_pusat.rekap_nilai', $data);
    }

    public function ujian()
    {
        $data = [
            'ujians' => Ujian::all(),
            'title' => 'Ujian',
            'page_title' => 'Ujian'
        ];

        return view('admin_pusat.ujian', $data);
    }
}
