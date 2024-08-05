<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ujian;
use App\Models\GuruQuran;
use App\Models\Nilai;

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

    public function kelompok_halaqah()
    {
        $guru_qurans = GuruQuran::with('siswa')->get();

        $data = [
            'guru_qurans' => $guru_qurans,
            'title' => 'Kelompok Halaqah',
            'page_title' => 'Kelompok Halaqah'
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