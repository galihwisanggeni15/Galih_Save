<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

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
    return view('login');
});

// Login Controller
Route::get('registrasihome', [LoginController::class, 'registrasihome'])->name('registrasihome');
Route::get('loginhome', [LoginController::class, 'loginhome'])->name('loginhome');
Route::post('/sesi/login', [LoginController::class, 'login']);
Route::post('/registrasi', [LoginController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout']);


// Admin Controller
Route::get('/admin/index', [AdminController::class, 'adminindex'])->name('adminindex');
Route::get('/admin/barang', [AdminController::class, 'adminbarang'])->name('adminbarang');
Route::get('/admin/data', [AdminController::class, 'admindata'])->name('admindata');
Route::get('/admin/user', [AdminController::class, 'adminuser'])->name('adminuser');
Route::get('/admin/datauser', [AdminController::class, 'dataadminuser'])->name('dataadminuser');
Route::get('/admin/datauser/aktif/{id}', [AdminController::class, 'dataadminuseraktif'])->name('dataadminuseraktif');
Route::get('/admin/datauser/nonaktif/{id}', [AdminController::class, 'dataadminusernonaktif'])->name('dataadminusernonaktif');
Route::get('/admin/datauser/tolak/{id}', [AdminController::class, 'dataadminusertolak'])->name('dataadminusertolak');
Route::get('/admin/datauser/hapus/{id}', [AdminController::class, 'dataadminuserhapus'])->name('dataadminuserhapus');

Route::get('/tambahbarang', [AdminController::class, 'tambahbarang'])->name('tambahbarang');
Route::get('/editbarang/{id}', [AdminController::class, 'editbarang'])->name('editbarang');
Route::get('/hapusbarang/{id}', [AdminController::class, 'hapusbarangsubmit'])->name('hapusbarang');
Route::post('/tambahbarangsubmit', [AdminController::class, 'tambahbarangsubmit'])->name('tambahbarangsubmit');
Route::post('/editbarangsubmit/{id}', [AdminController::class, 'editbarangsubmit'])->name('editbarangsubmit');
Route::post('/edituseradminsubmit', [AdminController::class, 'edituseradminsubmit'])->name('edituseradminsubmit');
Route::get('/konfirmasi/diterima{id}', [AdminController::class, 'konfirmasiditerima'])->name('konfirmasiditerima');
Route::get('/konfirmasi/ditolak/{id}', [AdminController::class, 'konfirmasiditolak'])->name('konfirmasiditolak');
Route::get('/konfirmasi/ditolak/{id}', [AdminController::class, 'konfirmasiditolak'])->name('konfirmasiditolak');
Route::get('/konfirmasi/ditolak/{id}', [AdminController::class, 'konfirmasiditolak'])->name('konfirmasiditolak');
Route::get('/konfirmasi/kembaliuser/{id}', [AdminController::class, 'konfirmasikembaliuser'])->name('konfirmasikembaliuser');
Route::get('/konfirmasi/pengembalianadmin/{id}', [AdminController::class, 'konfirmasipengembalianadmin'])->name('konfirmasipengembalianadmin');
Route::get('/konfirmasi/pengembalianadmin/{id}', [AdminController::class, 'konfirmasipengembalianadmin'])->name('konfirmasipengembalianadmin');
Route::get('/konfirmasi/hapus/{id}', [AdminController::class, 'konfirmasihapus'])->name('konfirmasihapus');


// User Controller
Route::get('/user/index', [UserController::class, 'userindex'])->name('userindex');
Route::get('/user/pinjaman', [UserController::class, 'userpinjaman'])->name('userpinjaman');
Route::get('/user/user', [UserController::class, 'useruser'])->name('useruser');

Route::get('/detailpinjaman/{id}', [UserController::class, 'detailpinjaman'])->name('detailpinjaman');
Route::post('/tambahpeminjaman', [UserController::class, 'tambahpeminjaman'])->name('tambahpeminjaman');
