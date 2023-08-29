<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\BangunanController;
use App\Http\Controllers\FileBangunanController;
use App\Http\Controllers\LoginController;
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



Route::middleware(['auth'])->group(function(){
    Route::resource('/tanah', TanahController::class);
    Route::resource('pegawai', PegawaiController::class);

    Route::get('user', [UserController::class, 'index']);
    Route::get('user/create', [UserController::class, 'create']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/{id}/edit', [UserController::class, 'edit']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
    Route::get('user/{id}', [UserController::class, 'show']);

    Route::resource('/bangunan',BangunanController::class);
    Route::get('/bangunan',[BangunanController::class, 'index']);
    Route::get('filebangunan/{filebangunan}', [FileBangunanController::class, 'destroy'])->name('filebangunan.destroy');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/',[LoginController::class, 'index'])->name('login');
    Route::post('/',[LoginController::class, 'auth']);
});