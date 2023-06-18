@extends('layouts.app')

@section('content')
<?php
use App\Models\Users;
use App\Models\RecipeImages;
use App\Models\Recipes;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Recepte</title>
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h2>{{ $receptes->title }}</h2>
            <h4 class="mb-4">Autors: {{ Users::find($receptes->userid)->name }}</h4>
            <p class="mb-4" style="font-size: 1.2rem">{{ $receptes->desc }}</p>
            <div class="d-flex mb-3">
                <h5 class="mr-4">Sagatavošanās laiks: {{ $receptes->preptime }}min</h5>
                <h5 class="mr-4">Pagatavošanas laiks: {{ $receptes->cooktime }}min</h5>
                <h5 class="mr-4">Porcijas: {{ $receptes->servings }}</h5>
            </div>
            <h5>Pagatavošana:</h5>
            <p style="font-size: 1.2rem">{{ $receptes->instructions }}</p>
            @php
                $recipeImage = RecipeImages::join('Recipes', 'recipe_images.recipeid', '=', 'recipes.id')
                    ->where('recipes.id', $receptes->id)
                    ->select('recipe_images.imageurl')
                    ->first();
            @endphp
            @if ($recipeImage)
                <img src="{{ $recipeImage->imageurl }}" class="card-img-top" alt="..." style="width: 300px">
            @endif
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>
@endsection