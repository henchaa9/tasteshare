<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecepteController;
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

/*Receptes*/

Route::get('/', [RecepteController::class, 'index']);

Route::get('/jaunarecepte', function () {
    return view('jaunarecepte');
})->name('jaunarecepte');

Route::get('/manasreceptes', [RecepteController::class, 'manasreceptes'])->name('manasreceptes');

Route::get('/rediget/{id}', [RecepteController::class, 'redigetview']);

Route::post('/saglabatReceptiRoute', [RecepteController::class, 'saglabatRecepti'])->name('saglabatRecepti');

Route::put('/redigetReceptiRoute/{id}', [RecepteController::class, 'redigetRecepti'])->name('redigetRecepti');

Route::get('/recepte/{id}', [RecepteController::class, 'raditrecepti'])->name('recepte');


/*Autorizācija*/

Route::get('/ielogoties', function () {
    return view('ielogoties');
});

Route::get('/registreties', function () {
    return view('registreties');
});

Auth::routes();


/*Meklēšana*/

Route::post('/search', [RecepteController::class, 'search'])->name('search');


/*Profils*/

Route::get('/profile', [UserController::class, 'profile'])->name('profile');

Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');

Route::put('/profile', [UserController::class, 'update'])->name('profile.update');

Route::get('/profile/update', function () {
    return view('update-profile');
})->name('profile.update-page');



/*Home*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



