@extends('layouts.app')

@section('content')
<?php
use App\Models\Users;
use App\Models\RecipeImages;
use App\Models\Recipes;
use App\Models\Upvotes;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Recepte</title>
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <style>
            .recipe-image {
                width: 500px;
                border-radius: 10px;
            }
            .text-justify {
                text-align: justify;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>{{ $receptes->title }}</h2>
                    <h5 class="mb-4">
                        Autors:
                        <a href="{{ route('public-profile', ['name' => Users::find($receptes->userid)->name]) }}" class="text-dark">
                            <u>{{ Users::find($receptes->userid)->name }}</u>
                        </a>
                    </h5>
                    <p class="mb-4 text-justify" style="font-size: 1.2rem">{{ $receptes->desc }}</p>
                    <div class="d-flex mb-3">
                        <h5 class="mr-4">Sagatavošanās laiks: {{ $receptes->preptime }} min.</h5>
                        <h5 class="mr-4">Gatavošanas laiks: {{ $receptes->cooktime }} min.</h5>
                        <h5 class="mr-4">Porciju skaits: {{ $receptes->servings }}</h5>
                    </div>

                </div>
                <div class="col-md-6">
                    @php
                        $recipeImage = RecipeImages::join('Recipes', 'recipe_images.recipeid', '=', 'recipes.id')
                            ->where('recipes.id', $receptes->id)
                            ->select('recipe_images.imageurl')
                            ->first();
                    @endphp
                    @if ($recipeImage)
                        <img src="{{ $recipeImage->imageurl }}" class="recipe-image" alt="Recipe Image" style="height: 300px">
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Large column taking the size of both previous columns -->
                    <h5>Pagatavošana:</h5>
                    <p class="text-justify" style="font-size: 1.2rem">{{ $receptes->instructions }}</p>
                </div>
            </div>
            <div class="row" style="max-width: 100px">
                @if (Auth::check())
                    @if ($receptes->userid == Auth::id())
                        <a type="button" class="d-inline btn btn-warning" href="rediget/{{ $receptes->id }}">Rediģēt</a>
                        <button type="button" class="d-inline btn btn-danger ml-1.1">Dzēst</button>
                    @else
                    <div id="upvote-button-{{ $receptes->id }}" class="btn-group" data-toggle="buttons">
                        <form id="favorites-form-{{ $receptes->id }}" action="{{ route('recipes.favorites.save', $receptes) }}" method="POST">
                            {{ csrf_field() }}
                            @method('PUT')
                            <a type="button" onclick="handleFavorite({{ $receptes->id }})" class="d-inline btn {{ $receptes->favoritedByUser() ? 'btn-warning' : 'btn-outline-warning' }}">
                                @if ($receptes->favoritedByUser())
                                    Saglabāta
                                @else
                                    Saglabāt
                                @endif
                            </a>
                        </form>
                        <form id="upvote-form-{{ $receptes->id }}" action="{{ route('recipes.upvote', $receptes) }}" method="POST">
                            {{ csrf_field() }}
                            @if ($receptes->isUpvotedByUser())
                                @method('DELETE')
                            @endif
                            <button type="button" onclick="handleUpvote({{ $receptes->id }})" class="d-inline btn ml-1 {{ $receptes->isUpvotedByUser() ? 'btn-danger' : 'btn-outline-danger' }}">Patīk: {{ $receptes->upvotes_count }}</button>
                        </form>
                    </div>
                    @endif
                @else
                    <a type="button" class="d-inline btn btn-outline-danger" href="login">Patīk</a>
                    <a type="button" class="d-inline btn btn-outline-danger ml-1" href="login">Saglabāt</a>
                @endif
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <script>
            function handleUpvote(recipeId) {
                var form = document.getElementById('upvote-form-' + recipeId);
                form.submit();
            }

            function handleFavorite(recipeId) {
                var form = document.getElementById('favorites-form-' + recipeId);
                form.submit();
            }
        </script>
    </body>
</html>
@endsection

