<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecepteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UpvoteController;

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

Route::delete('/manasreceptes/delete/{id}', [RecepteController::class,'delete'])->name('delete');





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

Route::get('/profile/delete', [UserController::class, 'confirmDelete'])->name('profile.confirmDelete');

Route::post('/profile/delete', [UserController::class, 'destroy'])->name('profile.delete');





/*Publisks profils*/

Route::get('/users/{name}', [UserController::class, 'publicProfile'])->name('public-profile');



// Upvote a post
Route::post('/recipes/{recepte}/upvote', [UpvoteController::class, 'upvote'])->name('recipes.upvote');


// Remove upvote from a post
Route::delete('/recipes/{recepte}/upvote', [UpvoteController::class, 'upvote'])->name('recipes.upvote');




/*Home*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



