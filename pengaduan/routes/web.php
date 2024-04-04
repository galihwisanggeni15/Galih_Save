<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('login.login');
});
Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login/submit', [AdminController::class, 'loginsubmit'])->name('loginsubmit');
Route::post('/register', [AdminController::class, 'register'])->name('register');



// USER
Route::get('/user/home', [AdminController::class, 'home'])->name('home');
Route::get('/user/pengajuan', [AdminController::class, 'pengajuan'])->name('pengajuan');
Route::post('/user/pengajuan/submit', [AdminController::class, 'pengajuansubmit'])->name('pengajuansubmit');
Route::post('/user/cekbarang', [AdminController::class, 'cekbarang'])->name('cekbarang');
// Route::get('/user/hasilpengajuan/{get}', [AdminController::class, 'hasilpengajuan'])->name('hasilpengajuan');


Route::get('/user/profil', [AdminController::class, 'userprofil'])->name('userprofil');
Route::get('/user/ubahpassword', [AdminController::class, 'userubahpassword'])->name('userubahpassword');
Route::post('/user/profil/submit/{id}', [AdminController::class, 'userprofilsubmit'])->name('userprofilsubmit');





// ADMIN
Route::get('/admin/index', [AdminController::class, 'adminindex'])->name('adminindex');
Route::get('/admin/databarang', [AdminController::class, 'admindatabarang'])->name('admindatabarang');
Route::get('/admin/datauser', [AdminController::class, 'admindatauser'])->name('admindatauser');
Route::get('/admin/profil', [AdminController::class, 'adminprofil'])->name('adminprofil');
Route::get('/admin/ubahpassword', [AdminController::class, 'adminubahpassword'])->name('adminubahpassword');
Route::post('/admin/ubahpassword/submit/{id}', [AdminController::class, 'adminubahpasswordsubmit'])->name('adminubahpasswordsubmit');



// STATUS BARANG
Route::get('/admin/databarang/detail/{id}', [AdminController::class, 'admindatabarangdetail'])->name('admindatabarangdetail');
Route::post('/admin/databarang/detail/submit/{id}', [AdminController::class, 'admindatabarangdetailsubmit'])->name('admindatabarangdetailsubmit');
Route::get('/admin/databarang/hapus/{id}', [AdminController::class, 'admindatabaranghapus'])->name('admindatabaranghapus');



// VERIF USER
Route::get('/admin/datauser/terima/{id}', [AdminController::class, 'admindatauserterima'])->name('admindatauserterima');
Route::get('/admin/datauser/tolak/{id}', [AdminController::class, 'admindatausertolak'])->name('admindatausertolak');
Route::get('/admin/datauser/blokir/{id}', [AdminController::class, 'admindatauserblokir'])->name('admindatauserblokir');
Route::get('/admin/datauser/hapus/{id}', [AdminController::class, 'admindatauserhapus'])->name('admindatauserhapus');
