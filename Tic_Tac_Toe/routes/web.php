<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tic_Tac_ToeController;
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

Route::controller(Tic_Tac_ToeController::class)->group(function(){
    Route::get('jeu/index','index')->name('jeu.index');
    Route::post('jeu/marquer','marquer')->name('jeu.marquer');
    Route::post('jeu/reinitialiser','reinitialiser')->name('jeu.reinitialiser');
});
