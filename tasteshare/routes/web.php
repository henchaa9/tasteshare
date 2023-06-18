<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecepteController;

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

Route::get('/', [RecepteController::class, 'index']);

Route::get('/jaunarecepte', function () {
    return view('jaunarecepte');
})->name('jaunarecepte');

Route::get('/manasreceptes', [RecepteController::class, 'manasreceptes'])->name('manasreceptes');

Route::get('/recepte/{id}', [RecepteController::class, 'raditrecepti']);

Route::get('/ielogoties', function () {
    return view('ielogoties');
});

Route::get('/registreties', function () {
    return view('registreties');
});

Route::post('/search', [RecepteController::class, 'search'])->name('search');


Route::post('/saglabatReceptiRoute', [RecepteController::class, 'saglabatRecepti'])->name('saglabatRecepti');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/recepte/{id}', [RecepteController::class, 'raditrecepti'])->name('recepte');

