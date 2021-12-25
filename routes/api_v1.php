<?php

use App\Http\Controllers\API\v1\PegawaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\v1\PetugasController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('petugas/login', [PetugasController::class, 'login'])->name('Login');
Route::get('petugas', [PetugasController::class, 'index'])->middleware('auth:api')->name('Ambil Data Petugas');
Route::post('petugas', [PetugasController::class, 'store'])->middleware('auth:api')->name('Insert Data Petugas');
Route::put('petugas/{petugas_id}',[PetugasController::class, 'update'])->middleware('auth:api')->name('Update Data Petugas');
Route::delete('petugas/{petugas_id}',[PetugasController::class, 'destroy'])->middleware('auth:api')->name('Delete Petugas');
Route::post('petugas/search',[PetugasController::class, 'search'])->middleware('auth:api')->name('search Petugas');

Route::get('pegawai', [PegawaiController::class, 'index'])->middleware('auth:api')->name('Ambil Data Pegawai');
Route::post('pegawai', [PegawaiController::class, 'store'])->middleware('auth:api')->name('Insert Data Pegawai');
Route::put('pegawai/{pegawai_id}',[PegawaiController::class, 'update'])->middleware('auth:api')->name('Update Data Pegawai');
Route::delete('pegawai/{pegawai_id}',[PegawaiController::class, 'destroy'])->middleware('auth:api')->name('Delete Pegawai');
Route::post('pegawai/search',[PegawaiController::class, 'search'])->middleware('auth:api')->name('search Pegawai');
