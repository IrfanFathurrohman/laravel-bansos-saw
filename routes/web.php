<?php


use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PenilaianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard',[DashboardController::class,'index']);
Route::get('/bansos',[DashboardController::class,'bansos']);
Route::get('/warga',[DashboardController::class,'warga']);
Route::get('/kriteria',[DashboardController::class,'kriteria']);
Route::get('/bobot',[DashboardController::class,'bobot']);
Route::get('/penilaian',[DashboardController::class,'penilaian']);
Route::get('/pengajuan',[DashboardController::class,'pengajuan']);
Route::get('/lap_seluruh',[DashboardController::class,'lap_seluruh']);


Route::get('/bansos', [BansosController::class, 'bansos']);
Route::post('/bansos', [BansosController::class, 'tambah_data']);
Route::get('/bansos/{id}/edit', [BansosController::class, 'edit']);
Route::post('/bansos/{id}', [BansosController::class, 'update']);
Route::delete('/bansos/{id}', [BansosController::class, 'destroy']);

Route::get('/warga', [WargaController::class, 'warga']);
Route::post('/warga', [WargaController::class, 'store']);
Route::get('/warga/{id}/edit', [WargaController::class, 'edit']);
Route::post('/warga/{id}', [WargaController::class, 'update']);
Route::delete('/warga/{id}', [WargaController::class, 'destroy']);

Route::get('/navbar', [NavbarController::class, 'navbar']);


// Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
// Route::get('/kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
// Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
// Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
// Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

Route::resource('kriteria', KriteriaController::class);


// Route::get('/bobot', [BobotController::class, 'index'])->name('bobot.index');
// Route::post('/bobot', [BobotController::class, 'store'])->name('bobot.store');
// Route::get('/bobot/{id}/edit', [BobotController::class, 'edit'])->name('bobot.edit');
// Route::put('/bobot/{id}', [BobotController::class, 'update'])->name('bobot.update');
// Route::delete('/bobot/{id}', [BobotController::class, 'destroy'])->name('bobot.destroy');

Route::resource('bobot', BobotController::class);

Route::resource('penilaian', PenilaianController::class);

Route::resource('pengajuan', PengajuanController::class);

// routes/web.php

Route::prefix('pengajuan')->group(function () {
    Route::get('/', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('store', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('edit/{id}', [PengajuanController::class, 'edit'])->name('pengajuan.edit');
    Route::post('update/{id}', [PengajuanController::class, 'update'])->name('pengajuan.update');
    Route::get('delete/{id}', [PengajuanController::class, 'destroy'])->name('pengajuan.destroy');
});


Route::post('fetch-kriteria', [PengajuanController::class, 'fetchKriteria'])->name('fetch.kriteria');


