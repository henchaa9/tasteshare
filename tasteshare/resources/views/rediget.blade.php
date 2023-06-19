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
        <title>Rediģēt recepti | TasteShare</title>
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
    <body class="antialiased">
    <div class="container">
        <h2>Rediģēt recepti</h2>
        <a>*Obligātie lauki</a>
        <form method="post" action="{{ route('redigetRecepti', $receptes->id) }}">
            {{ csrf_field() }}
            <label class="d-block mt-3 font-weight-bolder" for="nosaukums" style="font-size:1.1rem">Nosaukums*</label>
            <input class="mb-4 w-50 p-1" type="text" name="nosaukums" value="{{ $receptes->title }}" id="" required>
            
            <label class="d-block font-weight-bolder" for="apraksts" style="font-size:1.1rem">Apraksts*</label>
            <textarea class="mb-4 p-1 w-50" name="apraksts" id="" cols="20" rows="10" required>{{ $receptes->desc }}</textarea>

            <label class="d-block font-weight-bolder" for="sagatavosanasLaiks" style="font-size:1.1rem">Sagatavošanās laiks (min.)*</label>
            <input class="mb-4 p-1" type="number" name="sagatavosanasLaiks" id="" value="{{ $receptes->preptime }}" required>

            <label class="d-block font-weight-bolder" for="pagatavosanasLaiks" style="font-size:1.1rem">Pagatavošanas laiks (min.)*</label>
            <input class="mb-4 p-1" type="number" name="pagatavosanasLaiks" id="" value="{{ $receptes->cooktime }}" required>

            <label class="d-block font-weight-bolder" for="porcijas" style="font-size:1.1rem">Porciju skaits*</label>
            <input class="mb-4 p-1" type="number" name="porcijas" id="" value="{{ $receptes->servings }}" required>

            <label class="d-block font-weight-bolder" for="pagatavosana" style="font-size:1.1rem">Pagatavošana*</label>
            <textarea class="mb-4 p-1 w-50 d-block" name="pagatavosana" id="" cols="20" rows="10" required>{{ $receptes->instructions }}</textarea>

            <label class="d-block font-weight-bolder" for="foto" style="font-size:1.1rem">Saite uz attēlu</label>
            @php
                $recipeImage = RecipeImages::join('Recipes', 'recipe_images.recipeid', '=', 'recipes.id')
                    ->where('recipes.id', $receptes->id)
                    ->select('recipe_images.imageurl')
                    ->first();
            @endphp
            @if ($recipeImage)
                <input class="mb-4 p-1 d-block w-50" type="url" name="foto" id="" value="{{ $recipeImage->imageurl }}">
            @else
                <input class="mb-4 p-1 d-block w-50" type="url" name="foto" id="">
            @endif

            <label class="d-block font-weight-bolder" for="ispublic" style="font-size:1.1rem">Privāts/Publisks ieraksts</label>
            <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="ispublic" name="ispublic" {{ $receptes->ispublic ? 'checked' : '' }}>
            <label class="custom-control-label" for="ispublic"></label>
            </div>


            @method('PUT')
            <div class="mt-5">
            <button type="submit" class="btn btn-primary d-inline mb-3">Saglabāt</button>
            <button type="reset" class="btn btn-danger d-inline mb-3">Dzēst</button>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>
@endsection