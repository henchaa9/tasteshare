<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('recipes', RecipesController::class);
    $router->resource('recipe-images', RecipeImageController::class);
    $router->resource('favorites', FavoritesController::class);
    $router->resource('upvotes', UpvoteController::class);
});
