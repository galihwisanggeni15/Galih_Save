<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
    return view('index');
});

// HOME CONTROLLER
Route::get('sigup', [HomeController::class, 'index']);
Route::get('index', [HomeController::class, 'create']);

// REGISTER CONTROLLER
Route::POST('/sesi/register', [RegisterController::class, 'store']);
Route::POST('/sesi/login', [RegisterController::class, 'login']);

// ADMIN CONTROLLER
Route::get('/admin/index', [AdminController::class, 'index'])->name('index')->middleware('auth');
Route::get('/admin/dataproduct', [AdminController::class, 'dataproduct'])->name('dataproduct');
Route::get('/admin/datacategory', [AdminController::class, 'datacategory']);
Route::get('/admin/tambahdatacategory', [AdminController::class, 'linktambahdatacategory']);
Route::get('/admin/profil', [AdminController::class, 'profil'])->name('profil')->middleware('auth');
Route::post('/admin/profil/update', [AdminController::class, 'update'])->name('profil');
Route::get('/admin/tambahdata', [AdminController::class, 'tambah']);
Route::POST('/admin/store', [AdminController::class, 'store'])->name('store');
Route::get('/admin/edit/product/{id}', [AdminController::class, 'edit'])->name('edit.product');
Route::post('/admin/update/product/{id}', [AdminController::class, 'updateproduct'])->name('updateproduct');
Route::get('/admin/hapus/product/{id}', [AdminController::class, 'destroy'])->name('destroy');
Route::post('/admin/tambahkategori', [AdminController::class, 'tambahkategori']);
Route::get('/admin/edit/category/{id}', [AdminController::class, 'linkupdatecategory']);
Route::POST('/admin/editkategori/{id}', [AdminController::class, 'updatecategory']);
Route::get('/admin/hapus/category/{id}', [AdminController::class, 'hapuscategory']);
Route::get('/admin/logout', [AdminController::class, 'logout']);

// USER CONTROLLER
Route::get('/user/index', [UserController::class, 'index'])->name('index')->middleware('auth');
Route::get('/user/profil', [UserController::class, 'profil']);
Route::get('/user/dataproduct', [UserController::class, 'profil']);
Route::get('/user/linkbeliproduk/{id}', [UserController::class, 'linkbeliproduk']);
Route::post('/user/beliproduk/{id}', [UserController::class, 'beliproduk']);
Route::post('/user/profil/update', [UserController::class, 'updateprofil']);
Route::get('/user/lengkap/{id}', [UserController::class, 'deskripsiproduk']);
Route::get('/user/logout', [UserController::class, 'logout']);