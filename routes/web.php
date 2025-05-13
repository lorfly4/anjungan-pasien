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

Route::get('/', [App\Http\Controllers\awalController::class, 'index']);

// BPJS Routes
Route::prefix('bpjs')->group(function () {
    Route::get('/', [App\Http\Controllers\bpjsController::class, 'index']);
    Route::post('/', [App\Http\Controllers\bpjsController::class, 'validasiUser']);
    Route::get('/lama', [App\Http\Controllers\bpjsController::class, 'pasien_lama_bpjs']);
    Route::get('/baru', [App\Http\Controllers\bpjsController::class, 'pasien_baru_bpjs']);
    Route::post('/baru', [App\Http\Controllers\bpjsController::class, 'pasien_baru_bpjs_input']);
    Route::post('/buatPasienBaru', [App\Http\Controllers\bpjsController::class, 'store']);
});

// Umum Routes
Route::prefix('umum')->group(function () {
    Route::get('/', [App\Http\Controllers\umumController::class, 'index']);
    Route::post('/', [App\Http\Controllers\umumController::class, 'validasiUser']);
    Route::get('/lama', [App\Http\Controllers\umumController::class, 'pasien_lama_umum']);
    Route::post('/lama', [App\Http\Controllers\umumController::class, 'cari_pasien']);
    Route::get('/baru', [App\Http\Controllers\umumController::class, 'pasien_baru_umum']);
    Route::post('/baru', [App\Http\Controllers\umumController::class, 'pasien_baru_umum_input']);
    Route::post('/buatPasienBaru', [App\Http\Controllers\umumController::class, 'store']);
    Route::get('/registrasi', [App\Http\Controllers\umumController::class, 'registrasi']);
    Route::post('/print', [App\Http\Controllers\umumController::class, 'printAntrian']);
    Route::get('/dokter', [App\Http\Controllers\umumController::class, 'dokter']);
    Route::post('/dokter', [App\Http\Controllers\umumController::class, 'dokter']);
});

