<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminPusatController;
use App\Http\Controllers\PPQController;
use App\Http\Controllers\AdminUnitController;
use App\Http\Controllers\GuruQuranController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/welcome', [LoginController::class, 'index'])->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'admin-pusat', 'checkRole:admin-pusat'], function () {
        Route::get('/dashboard', [AdminPusatController::class, 'dashboard'])->name('admin_pusat.dashboard');
        Route::get('/kelompok-halaqah', [AdminPusatController::class, 'kelompok_halaqah'])->name('admin_pusat.kelompok_halaqah');
        Route::get('/rekap-nilai', [AdminPusatController::class, 'rekap_nilai'])->name('admin_pusat.rekap_nilai');
        Route::get('/ujian', [AdminPusatController::class, 'ujian'])->name('admin_pusat.ujian');
        Route::prefix('users')->group(function () {
            Route::get('/admin-pusat', [AdminPusatController::class, 'admin_pusat'])->name('admin_pusat.users.admin_pusat');
            Route::get('/ppq', [AdminPusatController::class, 'ppq'])->name('admin_pusat.users.ppq');
            Route::get('/admin-unit', [AdminPusatController::class, 'admin_unit'])->name('admin_pusat.users.admin_unit');
            Route::get('/guru_quran', [AdminPusatController::class, 'guru_quran'])->name('admin_pusat.users.guru_quran');
        });
    });

    Route::group(['prefix' => 'ppq', 'checkRole:ppq'], function () {
        Route::get('/dashboard', [PPQController::class, 'dashboard'])->name('ppq.dashboard');
        Route::get('/kelompok-halaqah', [PPQController::class, 'kelompok_halaqah'])->name('ppq.kelompok_halaqah');
        Route::get('/rekap-nilai', [PPQController::class, 'rekap_nilai'])->name('ppq.rekap_nilai');
    });

    Route::group(['prefix' => 'admin-unit', 'checkRole:admin-unit'], function () {
        Route::get('/dashboard', [AdminUnitController::class, 'dashboard'])->name('admin_unit.dashboard');
        Route::get('/kelompok-halaqah', [AdminUnitController::class, 'kelompok_halaqah'])->name('admin_unit.kelompok_halaqah');
        Route::get('/rekap-nilai', [AdminUnitController::class, 'rekap_nilai'])->name('admin_unit.rekap_nilai');
    });

    Route::group(['prefix' => 'guru-quran', 'checkRole:guru-quran'], function () {
        Route::get('/dashboard', [GuruQuranController::class, 'dashboard'])->name('guru_quran.dashboard');
        Route::get('/kelompok-halaqah', [GuruQuranController::class, 'kelompok_halaqah'])->name('guru_quran.kelompok_halaqah');
        Route::get('/mutabaah', [GuruQuranController::class, 'mutabaah'])->name('guru_quran.mutabaah');
        Route::get('/nilai', [GuruQuranController::class, 'nilai'])->name('guru_quran.nilai');
        Route::prefix('nilais')->group(function () {
            Route::get('/tahsin', [GuruQuranController::class, 'tahsin'])->name('guru_quran.nilais.tahsin');
            Route::get('/tasmi', [GuruQuranController::class, 'tasmi'])->name('guru_quran.nilais.tasmi');
            Route::get('/tahfidz', [GuruQuranController::class, 'tahfidz'])->name('guru_quran.nilais.tahfidz');
        });
    });
});
