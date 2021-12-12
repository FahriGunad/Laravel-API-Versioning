<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\PetugasController;
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
Route::get('petugas', [PetugasController::class, 'index'])->middleware('auth:api')->name('Get Data Petugas');
Route::post('petugas', [PetugasController::class, 'store'])->name('Insert Data Petugas');
Route::put('petugas/{petugas_id}',[PetugasController::class, 'update'])->name('Update Data Petugas');
Route::delete('petugas/{petugas_id}',[PetugasController::class, 'destroy'])->name('Delete Petugas');
Route::post('petugas/search',[PetugasController::class, 'search'])->middleware('auth:api')->name('search Petugas');
