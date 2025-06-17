    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Middleware\IsUser;
    use App\Http\Middleware\IsAdmin;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\CreateUserController;
    use App\Http\Controllers\PoliController;
    use App\Http\Controllers\DokterController;
    use App\Http\Controllers\KategoriController;
    use App\Http\Controllers\UserserversideController;


    Route::get('/', function () {
        return view('welcome');
    });



    Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');

    Route::post('/login/proseslogin', [App\Http\Controllers\LoginController::class, 'proseslogin'])->name('login.proseslogin');

    Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    //Tampilan depan

    Route::get('/plasmaantrian', [\App\Http\Controllers\PlasmaController::class, 'index'])->name('plasma.index');
    Route::post('/plasmaantrian/panggil', [\App\Http\Controllers\PlasmaController::class, 'panggil'])->name('plasma.panggil');
    Route::post('/plasmaantrian/reset', [\App\Http\Controllers\PlasmaController::class, 'reset'])->name('plasma.reset');


    Route::get('/data', [\App\Http\Controllers\RiwayatantriansController::class, 'index'])->name('riwayatantrians.index');
    Route::post('/data/panggil', [\App\Http\Controllers\RiwayatantriansController::class, 'panggil'])->name('riwayatantrians.panggil');
    Route::post('/antrian/reset', [\App\Http\Controllers\RiwayatantriansController::class, 'reset'])->name('riwayatantrians.reset');



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


        Route::get('admin/tablekategori', [\App\Http\Controllers\KategoriController::class, 'index'])->name('tablecreatekategori.index');

        Route::get('admin/showcreatekategori', [\App\Http\Controllers\KategoriController::class, 'showcreatekategori'])->name('kategori.showcreatekategori');

        Route::post('admin/prosescreatekategori', [\App\Http\Controllers\KategoriController::class, 'prosescreatekategori'])->name('kategori.prosescreatekategori');

        Route::get('admin/showeditkategori/{id_kategoris}', [App\Http\Controllers\KategoriController::class, 'showeditkategori'])->name('kategori.showeditkategori');

        Route::post('admin/proseseditkategori/{id_kategoris}', [App\Http\Controllers\KategoriController::class, 'proseseditkategori'])->name('kategori.proseseditkategori');

        Route::delete('admin/deletekategori/{id_kategoris}',[App\Http\Controllers\KategoriController::class, 'deletekategori'])->name('kategori.deletekategori');

        Route::get('admin/tableloket', [App\Http\Controllers\LoketController::class, 'index'])->name('loket.index');

        Route::get('admin/showcreateloket', [App\Http\Controllers\LoketController::class, 'showcreateloket'])->name('loket.showcreateloket');

        Route::post('admin/prosescreateloket', [App\Http\Controllers\LoketController::class, 'prosescreateloket'])->name('loket.prosescreateloket');

        Route::get('admin/showeditloket/{id_lokets}', [App\Http\Controllers\LoketController::class, 'showeditloket'])->name('loket.showeditloket');

        Route::put('admin/proseseditloket/{id_lokets}', [App\Http\Controllers\LoketController::class, 'proseseditloket'])->name('loket.proseseditloket');

        Route::delete('admin/prosesdeleteloket/{id_lokets}', [App\Http\Controllers\LoketController::class, 'prosesdeleteloket'])->name('loket.prosesdeleteloket');

        // Serverside
        Route::get('admin/tabeluserserverside', [App\Http\Controllers\UserserversideController::class, 'index'])->name('userserverside.index');
        //Serverside

        Route::get('/admin/tablecreatejadwaldokter', [App\Http\Controllers\DokterController::class, 'tablecreatejadwaldokter'])->name('dokter.tablecreatejadwaldokter');

        Route::get('admin/showcreatejadwaldokter', [App\Http\Controllers\DokterController::class, 'showcreatejadwaldokter'])->name('dokter.showcreatejadwaldokter');

        Route::post('admin/prosescreatejadwaldokter', [App\Http\Controllers\DokterController::class, 'prosescreatejadwaldokter'])->name('dokter.prosescreatejadwaldokter');

        Route::get('admin/showeditjadwaldokter/{id_jadwal_dokter}', [App\Http\Controllers\DokterController::class, 'showeditjadwaldokter'])->name('dokter.showeditjadwaldokter');

        Route::put('admin/proseseditjadwaldokter/{id_jadwal_dokter}', [App\Http\Controllers\DokterController::class, 'proseseditjadwaldokter'])->name('dokter.proseseditjadwaldokter');

        Route::delete('admin/deletejadwaldokter/{id_jadwal_dokter}', [App\Http\Controllers\DokterController::class, 'deletejadwaldokter'])->name('dokter.deletejadwaldokter');

        Route::get('admin/tablepasienumum/', [App\Http\Controllers\PasienUmumController::class, 'showtablepasienumum'])->name('pasienumum.showtablepasienumum');

        Route::get('admin/createpasienumum/', [App\Http\Controllers\PasienUmumController::class,'showcreatepasienumum'])->name('pasienumum.showcreatepasienumum');

        Route::post('admin/prosescreatepasienumum/', [App\Http\Controllers\PasienUmumController::class,'prosescreatepasienumum'])->name('pasienumum.prosescreatepasienumum');

        Route::get('admin/showeditpasienumum/{id_pasien}', [App\Http\Controllers\PasienUmumController::class, 'showeditpasienumum'])->name('pasienumum.showeditpasienumum');

        Route::put('admin/proseseditpasienumum/{id_pasien}', [App\Http\Controllers\PasienUmumController::class, 'proseseditpasienumum'])->name('pasienumum.proseseditpasienumum');

        Route::delete('admin/deletepasienumum/{id_pasien}', [App\Http\Controllers\PasienUmumController::class, 'deletepasienumum'])->name('pasienumum.deletepasienumum');

        Route::get('admin/tableriwayatantrianpasien/', [App\Http\Controllers\RiwayatAntriansController::class, 'showtableriwayatantrian'])->name('riwayatantrian.showtableriwayatantrian');

    });




    //ini user
    Route::middleware(['auth', 'App\Http\Middleware\IsUser', 'App\Http\Middleware\PreventBack'])->group(function () {
        Route::get('/user/dashboard', [App\Http\Controllers\DashboardController::class, 'userdashboard'])->name('dashboard.userdashboard');

    });


