<?php

use App\Http\Controllers\Admin\ImportDataController;
use App\Http\Controllers\Admin\KerjaPraktekController as AdminKerjaPraktekController;
use App\Http\Controllers\Admin\TugasAkhirController as AdminTugasAkhirController;
use App\Http\Controllers\KerjaPraktekController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TugasAkhirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('beranda');

Route::get('/tugas-akhir', [TugasAkhirController::class, 'index']);
Route::get('/tugas-akhir/{tugasAkhir}', [TugasAkhirController::class, 'show']);

Route::get('/kerja-praktek', [KerjaPraktekController::class, 'index']);
Route::get('/kerja-praktek/{kerjaPraktek}', [KerjaPraktekController::class, 'show']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tugas-akhir/laporan/{tugasAkhir}', [TugasAkhirController::class, 'view_laporan_final_pdf'])
        ->name('view_ta_laporan_final_pdf');
    Route::get('/tugas-akhir/artikel/{tugasAkhir}', [TugasAkhirController::class, 'view_artikel_pdf'])
        ->name('view_ta_artikel_pdf');
    Route::get('/tugas-akhir/pendahuluan/{tugasAkhir}', [TugasAkhirController::class, 'view_pendahuluan_pdf'])
        ->name('view_ta_pendahuluan_pdf');
    Route::get('/tugas-akhir/abstrak/{tugasAkhir}', [TugasAkhirController::class, 'view_abstrak_pdf'])
        ->name('view_ta_abstrak_pdf');
    Route::get('/tugas-akhir/bab1/{tugasAkhir}', [TugasAkhirController::class, 'view_bab1_pdf'])
        ->name('view_ta_bab1_pdf');
    Route::get('/tugas-akhir/bab2/{tugasAkhir}', [TugasAkhirController::class, 'view_bab2_pdf'])
        ->name('view_ta_bab2_pdf');
    Route::get('/tugas-akhir/bab3/{tugasAkhir}', [TugasAkhirController::class, 'view_bab3_pdf'])
        ->name('view_ta_bab3_pdf');
    Route::get('/tugas-akhir/bab4/{tugasAkhir}', [TugasAkhirController::class, 'view_bab4_pdf'])
        ->name('view_ta_bab4_pdf');
    Route::get('/tugas-akhir/bab5/{tugasAkhir}', [TugasAkhirController::class, 'view_bab5_pdf'])
        ->name('view_ta_bab5_pdf');
    Route::get('/tugas-akhir/daftar_pustaka/{tugasAkhir}', [TugasAkhirController::class, 'view_daftar_pustaka_pdf'])
        ->name('view_ta_daftar_pustaka_pdf');
    Route::get('/tugas-akhir/lampiran/{tugasAkhir}', [TugasAkhirController::class, 'view_lampiran_pdf'])
        ->name('view_ta_lampiran_pdf');
    Route::get('/tugas-akhir/biodata/{tugasAkhir}', [TugasAkhirController::class, 'view_biodata_pdf'])
        ->name('view_ta_biodata_pdf');

    Route::get('/kerja-praktek/laporan/{kerjaPraktek}', [KerjaPraktekController::class, 'view_laporan_final_pdf'])
        ->name('view_kp_laporan_final_pdf');
    Route::get('/kerja-praktek/pendahuluan/{kerjaPraktek}', [KerjaPraktekController::class, 'view_pendahuluan_pdf'])
        ->name('view_kp_pendahuluan_pdf');
    Route::get('/kerja-praktek/bab1/{kerjaPraktek}', [KerjaPraktekController::class, 'view_bab1_pdf'])
        ->name('view_kp_bab1_pdf');
    Route::get('/kerja-praktek/bab2/{kerjaPraktek}', [KerjaPraktekController::class, 'view_bab2_pdf'])
        ->name('view_kp_bab2_pdf');
    Route::get('/kerja-praktek/bab3/{kerjaPraktek}', [KerjaPraktekController::class, 'view_bab3_pdf'])
        ->name('view_kp_bab3_pdf');
    Route::get('/kerja-praktek/bab4/{kerjaPraktek}', [KerjaPraktekController::class, 'view_bab4_pdf'])
        ->name('view_kp_bab4_pdf');
    Route::get('/kerja-praktek/bab5/{kerjaPraktek}', [KerjaPraktekController::class, 'view_bab5_pdf'])
        ->name('view_kp_bab5_pdf');
    Route::get('/kerja-praktek/bab6/{kerjaPraktek}', [KerjaPraktekController::class, 'view_bab6_pdf'])
        ->name('view_kp_bab6_pdf');
    Route::get('/kerja-praktek/daftar_pustaka/{kerjaPraktek}', [KerjaPraktekController::class, 'view_daftar_pustaka_pdf'])
        ->name('view_kp_daftar_pustaka_pdf');
    Route::get('/kerja-praktek/lampiran/{kerjaPraktek}', [KerjaPraktekController::class, 'view_lampiran_pdf'])
        ->name('view_kp_lampiran_pdf');
    Route::get('/kerja-praktek/biodata/{kerjaPraktek}', [KerjaPraktekController::class, 'view_biodata_pdf'])
        ->name('view_kp_biodata_pdf');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/import', [ImportDataController::class, 'import_user'])->name('users.import');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/tugas-akhir', [AdminTugasAkhirController::class, 'index'])->name('ta.index');
    Route::get('/tugas-akhir/create', [AdminTugasAkhirController::class, 'create'])->name('ta.create');
    Route::post('/tugas-akhir/store', [AdminTugasAkhirController::class, 'store'])->name('ta.store');
    Route::get('/tugas-akhir/{tugasAkhir}/edit', [AdminTugasAkhirController::class, 'edit'])->name('ta.edit');
    Route::put('/tugas-akhir/{tugasAkhir}/update', [AdminTugasAkhirController::class, 'update'])->name('ta.update');
    Route::delete('/tugas-akhir/{tugasAkhir}/delete', [AdminTugasAkhirController::class, 'destroy'])->name('ta.destroy');
    Route::get('/tugas-akhir/import-data', [ImportDataController::class, 'import_data_ta'])->name('ta.import');

    Route::get('/tugas-akhir/{tugasAkhir}', [AdminTugasAkhirController::class, 'show'])->name('ta.show');

    

    Route::get('/kerja-praktek', [AdminKerjaPraktekController::class, 'index'])->name('kp.index');
    Route::get('/kerja-praktek/create', [AdminKerjaPraktekController::class, 'create'])->name('kp.create');
    Route::post('/kerja-praktek/store', [AdminKerjaPraktekController::class, 'store'])->name('kp.store');
    Route::get('/kerja-praktek/{kerjaPraktek}/edit', [AdminKerjaPraktekController::class, 'edit'])->name('kp.edit');
    Route::put('/kerja-praktek/{kerjaPraktek}/update', [AdminKerjaPraktekController::class, 'update'])->name('kp.update');
    Route::delete('/kerja-praktek/{kerjaPraktek}/delete', [AdminKerjaPraktekController::class, 'destroy'])->name('kp.destroy');
    Route::get('/kerja-praktek/import-data', [ImportDataController::class, 'import_data_kp'])->name('kp.import');
    
    Route::get('/kerja-praktek/{kerjaPraktek}', [AdminKerjaPraktekController::class, 'show'])->name('kp.show');

    

    Route::view('/akses-tugas-akhir', 'admin.akses_ta.index')->name('akses_ta.index');
    Route::view('/akses-kerja-praktek', 'admin.akses_kp.index')->name('akses_kp.index');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});
