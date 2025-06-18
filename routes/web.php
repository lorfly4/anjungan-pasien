<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', action: [App\Http\Controllers\awalController::class, 'index']);
Route::get('/print', action: [App\Http\Controllers\awalController::class, 'print']);
Route::post('/print/simpan', action: [App\Http\Controllers\awalController::class, 'simpanAntrian']);

// BPJS Routes      
Route::prefix('bpjs')->group(function () {
    Route::get('/', [App\Http\Controllers\bpjsController::class, 'index']);
    Route::post('/', [App\Http\Controllers\bpjsController::class, 'validasiUser']);
    Route::get('/lama', [App\Http\Controllers\bpjsController::class, 'pasien_lama_bpjs']);
    Route::post('/lama', [App\Http\Controllers\bpjsController::class, 'cari_pasien']);
    Route::get('/baru', [App\Http\Controllers\bpjsController::class, 'pasien_baru_bpjs']);
    Route::post('/baru', [App\Http\Controllers\bpjsController::class, 'pasien_baru_bpjs']);
    Route::post('/baru', [App\Http\Controllers\bpjsController::class, 'pasien_baru_bpjs_input']);
    Route::get('/buatPasienBaru', [App\Http\Controllers\bpjsController::class, 'store']);
    Route::post('/buatPasienBaru', [App\Http\Controllers\bpjsController::class, 'store']);
    Route::get('/registrasi', [App\Http\Controllers\bpjsController::class, 'registrasi']);
    Route::post('/registrasi', [App\Http\Controllers\bpjsController::class, 'registrasi']);
    Route::post('/print', [App\Http\Controllers\bpjsController::class, 'previewAntrian']);
    Route::post('/print/simpan', [App\Http\Controllers\bpjsController::class, 'simpanAntrian']);
    Route::get('/dokter', [App\Http\Controllers\bpjsController::class, 'dokter']);
    Route::post('/dokter', [App\Http\Controllers\bpjsController::class, 'dokter']);
});

// Umum Routes
Route::prefix('umum')->group(function () {
    Route::get('/', [App\Http\Controllers\umumController::class, 'index']);
    Route::post('/', [App\Http\Controllers\umumController::class, 'validasiUser']);
    Route::get('/lama', [App\Http\Controllers\umumController::class, 'pasien_lama_umum']);
    Route::post('/lama', [App\Http\Controllers\umumController::class, 'cari_pasien']);
    Route::get('/baru', [App\Http\Controllers\umumController::class, 'pasien_baru_umum']);
    Route::post('/baru', [App\Http\Controllers\umumController::class, 'pasien_baru_umum']);
    Route::post('/baru', [App\Http\Controllers\umumController::class, 'pasien_baru_umum_input']);
    Route::get('/buatPasienBaru', [App\Http\Controllers\umumController::class, 'store']);
    Route::post('/buatPasienBaru', [App\Http\Controllers\umumController::class, 'store']);
    Route::get('/registrasi', [App\Http\Controllers\umumController::class, 'registrasi']);
    Route::post('/registrasi', [App\Http\Controllers\umumController::class, 'registrasi']);
    Route::post('/print', [App\Http\Controllers\umumController::class, 'previewAntrian']);
    Route::post('/print/simpan', [App\Http\Controllers\umumController::class, 'simpanAntrian']);
    Route::get('/dokter', [App\Http\Controllers\umumController::class, 'dokter']);
    Route::post('/dokter', [App\Http\Controllers\umumController::class, 'dokter']);
    Route::get('/pilih-jadwal', [App\Http\Controllers\umumController::class, 'pilihJadwal']);
    Route::post('/pilih-jadwal', [App\Http\Controllers\umumController::class, 'pilihJadwal']);
});