<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\PegawaiController;

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
Route::get('/pegawai', [PegawaiController::class, 'index'] );
Route::get('/pegawai/create', [PegawaiController::class, 'create'] );
Route::post('/pegawai/create', [PegawaiController::class, 'store']);
Route::get('/pegawai/{id}', [PegawaiController::class, 'edit']);
Route::put('/pegawai/{id}', [PegawaiController::class, 'update']);