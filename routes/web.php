<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\PoliController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');

Route::post('/login/proseslogin', [App\Http\Controllers\LoginController::class, 'proseslogin'])->name('login.proseslogin');

Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');


//ini admin
Route::middleware(['auth', 'App\Http\Middleware\IsAdmin', 'App\Http\Middleware\PreventBack'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'admindashboard'])->name('dashboard.admindashboard');

    Route::get('/admin/createuser', [App\Http\Controllers\CreateUserController::class, 'index'])->name('createuser.index');

    Route::get('/admin/buatuser', [App\Http\Controllers\CreateUserController::class, 'showcreateuser'])->name('createuser.showcreateuser');
    Route::post('/admin/prosesbuatuser', [App\Http\Controllers\CreateUserController::class, 'prosescreateuser'])->name('createuser.prosescreateuser');

    Route::get('/admin/edituser/{id}', [App\Http\Controllers\CreateUserController::class, 'edituser'])->name('createuser.edituser');
    Route::post('/admin/prosesedituser/{id}', [App\Http\Controllers\CreateUserController::class, 'updateuser'])->name('createuser.updateuser');

    Route::delete('admin/deleteuser/{id}',[App\Http\Controllers\CreateUserController::class, 'deleteuser'])->name('createuser.deleteuser');

    Route::get('admin/createpoli', [App\Http\Controllers\PoliController::class, 'index'])->name('poli.index');
    Route::get('admin/showpoli', [App\Http\Controllers\PoliController::class, 'showpoli'])->name('poli.showpoli');
    Route::post('admin/prosescreatepoli', [App\Http\Controllers\PoliController::class, 'prosescreatepoli'])->name('poli.prosescreatepoli');

    Route::get('admin/editpoli/{id_poli}', [App\Http\Controllers\PoliController::class, 'showeditpoli'])->name('poli.showeditpoli');
    Route::post('admin/proseseditpoli/{id_poli}', [App\Http\Controllers\PoliController::class, 'proseseditpoli'])->name('poli.proseseditpoli');

    Route::delete('admin/deletepoli/{id_poli}',[App\Http\Controllers\PoliController::class, 'deletepoli'])->name('poli.deletepoli');

    Route::get('admin/tablecreatedokter', [App\Http\Controllers\DokterController::class, 'index'])->name('tablecreatedokter.index');
    Route::get('admin/createdokter', [App\Http\Controllers\DokterController::class, 'showcreatedokter'])->name('tablecreatedokter.showcreatedokter');
    Route::post('admin/prosescreatedokter', [App\Http\Controllers\DokterController::class, 'prosescreatedokter'])->name('tablecreatedokter.prosescreatedokter');
    
    Route::get('admin/editdokter/{id_dokter}', [App\Http\Controllers\DokterController::class, 'showeditdokter'])->name('tablecreatedokter.showeditdokter');
    Route::post('admin/proseseditdokter/{id_dokter}', [App\Http\Controllers\DokterController::class, 'proseseditdokter'])->name('tablecreatedokter.proseseditdokter');

    Route::delete('admin/prosesdeletedokter/{id_dokter}', [App\Http\Controllers\DokterController::class, 'deletedokter'])->name('tablecreatedokter.deletedokter');

});




//ini user
Route::middleware(['auth', 'App\Http\Middleware\IsUser', 'App\Http\Middleware\PreventBack'])->group(function () {
    Route::get('/user/dashboard', [App\Http\Controllers\DashboardController::class, 'userdashboard'])->name('dashboard.userdashboard');
});


