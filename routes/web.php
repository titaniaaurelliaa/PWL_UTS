<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [WelcomeController::class,'index']);

//route CRUD user
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    
    // Create dengan ajax
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru ajax
    
    Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
    
    // Edit dengan ajax
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
    
    // Delete dengan ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); //menampilkan form confirm delete user ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
});

//route CRUD level
Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']); // menampilkan halaman awal level
    Route::post('/list', [LevelController::class, 'list']); // menampilkan data level dalam bentuk json untuk datatables

    // Create dengan ajax
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah level ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // menyimpan data level baru ajax

    Route::get('/{id}', [LevelController::class, 'show']); // menampilkan detail level

    // Edit dengan ajax
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // menampilkan halaman form edit level ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level ajax

    // Delete dengan ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); //menampilkan form confirm delete level ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data level ajax
});

//route CRUD kategori
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']); // menampilkan halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']); // menampilkan data kategori dalam bentuk json untuk datatables

    // Create dengan ajax
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah kategori ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']); // menyimpan data kategori baru ajax

    Route::get('/{id}', [KategoriController::class, 'show']); // menampilkan detail kategori

    // Edit dengan ajax
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit kategori ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori ajax

    // Delete dengan ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); //menampilkan form confirm delete kategori ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data kategori ajax
});

//route CRUD film
Route::group(['prefix' => 'film'], function () {
    Route::get('/', [FilmController::class, 'index']);
    Route::post('/list', [FilmController::class, 'list']);

    // Create dengan ajax
    Route::get('/create_ajax', [FilmController::class, 'create_ajax']);
    Route::post('/ajax', [FilmController::class, 'store_ajax']);

    Route::get('/{id}', [FilmController::class, 'show']);

    // Edit dengan ajax
    Route::get('/{id}/edit_ajax', [FilmController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [FilmController::class, 'update_ajax']);

    // Delete dengan ajax
    Route::get('/{id}/delete_ajax', [FilmController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [FilmController::class, 'delete_ajax']);
});