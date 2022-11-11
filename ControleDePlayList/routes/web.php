<?php

use App\Http\Controllers\PastaController;
use App\Http\Controllers\PlaylistController;
use App\Models\Playlist;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('home');
});

Route::get('videos/buscar',[PlaylistController::class,'buscar']);
Route::resource('videos',PlaylistController::class);

Route::get('playlist/buscar',[PastaController::class,'buscar']);
Route::resource('playlist',PastaController::class);

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
