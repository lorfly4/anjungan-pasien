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