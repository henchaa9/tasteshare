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
    <title>TasteShare</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body class="antialiased">
<div class="container">
    <h2>Populārākās receptes</h2>
    <div class="row">
        <div class="col-md-6">
            @foreach ($receptes->where('ispublic', true)->take($receptes->count() / 2) as $recepte)
                <div class="card m-2">
                    @php
                    $recipeImage = RecipeImages::join('Recipes', 'recipe_images.recipeid', '=', 'recipes.id')
                        ->where('recipes.id', $recepte->id)
                        ->select('recipe_images.imageurl')
                        ->first();
                    @endphp
                    @if ($recipeImage)
                    <img src="{{ $recipeImage->imageurl }}" class="card-img-top" alt="..." style="height: 300px;">
                    @endif
                    <div class="card-body">
                        <a href="recepte/{{$recepte->id}}" class="text-dark">
                            <h4 class="card-title mb-1">{{ $recepte->title }}</h4>
                        </a>
                        <h6 class="card-title">Autors: {{ Users::find($recepte->userid)->name }}</h6>
                        <p class="card-text" style="max-height: 200px; overflow: hidden">{{ $recepte->desc }}</p>
                        <p class="card-text">Sagatavošanas laiks: {{ $recepte->preptime }} minūtes</p>
                        <p class="card-text">Gatavošanas laiks: {{ $recepte->cooktime }} minūtes</p>
                        <p class="card-text">Porciju skaits: {{ $recepte->servings }}</p>
                        @if (Auth::check())
                            @if ($recepte->userid == Auth::id())
                                <a type="button" class="d-inline btn btn-warning" href="rediget/{{ $recepte->id }}">Rediģēt</a>
                                <button type="button" class="d-inline btn btn-danger ml-1.1">Dzēst</button>
                            @else
                            <div id="upvote-button-{{ $recepte->id }}" class="btn-group" data-toggle="buttons">
                            <form id="favorites-form-{{ $recepte->id }}" action="{{ route('recipes.favorites.save', $recepte) }}" method="POST">
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <button type="button" onclick="handleFavorite({{ $recepte->id }})" class="d-inline btn {{ $recepte->favoritedByUser() ? 'btn-warning' : 'btn-outline-warning' }}">Saglabāt</button>
                                </form>
                                <form id="upvote-form-{{ $recepte->id }}" action="{{ route('recipes.upvote', $recepte) }}" method="POST">
                                    {{ csrf_field() }}
                                    @if ($recepte->isUpvotedByUser())
                                        @method('DELETE')
                                    @endif
                                    <button type="button" onclick="handleUpvote({{ $recepte->id }})" class="d-inline btn ml-1 {{ $recepte->isUpvotedByUser() ? 'btn-danger' : 'btn-outline-danger' }}">Patīk: {{ $recepte->upvotes_count }}</button>
                                </form>
                            </div>
                            @endif
                        @else
                            <a type="button" class="d-inline btn btn-outline-danger" href="login">Patīk</a>
                            <a type="button" class="d-inline btn btn-outline-danger ml-1" href="login">Saglabāt</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            @foreach ($receptes->where('ispublic', true)->skip($receptes->count() / 2) as $recepte)
                <div class="card m-2">
                    @php
                    $recipeImage = RecipeImages::join('Recipes', 'recipe_images.recipeid', '=', 'recipes.id')
                        ->where('recipes.id', $recepte->id)
                        ->select('recipe_images.imageurl')
                        ->first();
                    @endphp
                    @if ($recipeImage)
                    <img src="{{ $recipeImage->imageurl }}" class="card-img-top" alt="..." style="height: 300px;">
                    @endif
                    <div class="card-body">
                        <a href="recepte/{{$recepte->id}}" class="text-dark">
                            <h4 class="card-title mb-1">{{ $recepte->title }}</h4>
                        </a>
                        <h6 class="card-title">Autors: {{ Users::find($recepte->userid)->name }}</h6>
                        <p class="card-text" style="max-height: 200px; overflow: hidden">{{ $recepte->desc }}</p>
                        <p class="card-text">Sagatavošanas laiks: {{ $recepte->preptime }} minūtes</p>
                        <p class="card-text">Gatavošanas laiks: {{ $recepte->cooktime }} minūtes</p>
                        <p class="card-text">Porciju skaits: {{ $recepte->servings }}</p>
                        @if (Auth::check())
                            @if ($recepte->userid == Auth::id())
                                <a type="button" class="d-inline btn btn-warning" href="rediget/{{ $recepte->id }}">Rediģēt</a>
                                <button type="button" class="d-inline btn btn-danger ml-1.1">Dzēst</button>
                            @else
                            <div id="upvote-button-{{ $recepte->id }}" class="btn-group" data-toggle="buttons">

                                <form id="favorites-form-{{ $recepte->id }}" action="{{ route('recipes.favorites.save', $recepte) }}" method="POST">
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <button type="button" onclick="handleFavorite({{ $recepte->id }})" class="d-inline btn {{ $recepte->favoritedByUser() ? 'btn-warning' : 'btn-outline-warning' }}">Saglabāt</button>
                                </form>
                                <form id="upvote-form-{{ $recepte->id }}" action="{{ route('recipes.upvote', $recepte) }}" method="POST">
                                    {{ csrf_field() }}
                                    @if ($recepte->isUpvotedByUser())
                                        @method('DELETE')
                                    @endif
                                    <button type="button" onclick="handleUpvote({{ $recepte->id }})" class="d-inline btn ml-1 {{ $recepte->isUpvotedByUser() ? 'btn-danger' : 'btn-outline-danger' }}">Patīk: {{ $recepte->upvotes_count }}</button>
                                </form>
                            </div>
                            @endif
                        @else
                            <a type="button" class="d-inline btn btn-outline-danger" href="login">Patīk</a>
                            <a type="button" class="d-inline btn btn-outline-danger ml-1" href="login">Saglabāt</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

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
