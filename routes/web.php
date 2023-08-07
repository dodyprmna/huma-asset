<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\BangunanController;
use App\Http\Controllers\FileBangunanController;

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

Route::get('/tanah', [TanahController::class, 'index'] );
Route::resource('pegawai', PegawaiController::class);
Route::resource('/bangunan',BangunanController::class);
Route::get('filebangunan/{filebangunan}', [FileBangunanController::class, 'destroy'])->name('filebangunan.destroy');