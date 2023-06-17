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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jaunarecepte', function () {
    return view('jaunarecepte');
});

Route::get('/ielogoties', function () {
    return view('ielogoties');
});

Route::get('/registreties', function () {
    return view('registreties');
});

Route::post('/saglabatReceptiRoute', [RecepteController::class, 'saglabatRecepti'])->name('saglabatRecepti');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
