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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\awalController::class, 'index']);
Route::get('/bpjs', [App\Http\Controllers\bpjsController::class, 'index']);
Route::post('/bpjs', [App\Http\Controllers\bpjsController::class, 'validasiUser']);
Route::get('/bpjs/lama', [App\Http\Controllers\bpjsController::class, 'pasien_lama_bpjs']);
Route::get('/bpjs/baru', [App\Http\Controllers\bpjsController::class, 'pasien_baru_bpjs']);
Route::post('/bpjs/baru', [App\Http\Controllers\bpjsController::class, 'pasien_baru_bpjs_input']);
Route::post('/bpjs/buatPasienBaru', [App\Http\Controllers\bpjsController::class, 'store']);
Route::get('/umum', [App\Http\Controllers\umumController::class, 'index']);
Route::post('/umum', [App\Http\Controllers\umumController::class, 'validasiUser']);
Route::get('/umum/lama', [App\Http\Controllers\umumController::class, 'pasien_lama_umum']);
Route::get('/umum/baru', [App\Http\Controllers\umumController::class, 'pasien_baru_umum']);
Route::post('/umum/baru', [App\Http\Controllers\umumController::class, 'pasien_baru_umum_input']);
Route::post('/bpjs/buatPasienBaru', [App\Http\Controllers\bpjsController::class, 'store']);