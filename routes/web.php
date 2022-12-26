<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlubController;
use App\Http\Controllers\PertandinganKlubController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [KlubController::class, 'index']);
Route::get('/klub/create', [KlubController::class, 'create']);
Route::post('/klub/store', [KlubController::class, 'store']);
Route::get('/pertandingan/create', [PertandinganKlubController::class, 'create']);
Route::post('/pertandingan/store', [PertandinganKlubController::class, 'store']);
