@extends('layouts.app')

@section('content')
<?php
use App\Models\Users;
use App\Models\RecipeImages;
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
        <div class="row">
            <div class="col" style="max-width: 500px">
                @foreach ($receptes as $recepte )
                    @if ($recepte->id % 2 == 0 and $recepte->ispublic == true)
                        <div class="card m-2">
                            @if (RecipeImages::find($recepte->id)->imageurl)
                                <img src="{{ RecipeImages::find($recepte->id)->imageurl}}"  class="card-img-top" alt="..." style="height: 300px">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title mb-1">{{ $recepte->title }}</h5>
                                <h5 class="card-title">{{ Users::find($recepte->userid)->name }}</h5>
                                <p class="card-text" style="max-height: 200px; overflow: hidden">{{ $recepte->desc }}</p>
                                @if (Auth::check())
                                    <button type="button" class="d-inline btn btn-outline-danger">Patīk</button>
                                    <button type="button" class="d-inline btn btn-outline-danger ml-1">Saglabāt</button> 
                                @endif
                                @if (Auth::guest())
                                    <button type="button" class="d-inline btn btn-outline-danger" href="login">Patīk</button>
                                    <button type="button" class="d-inline btn btn-outline-danger ml-1" href="login">Saglabāt</button> 
                                @endif 
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col" style="max-width: 500px">
                @foreach ($receptes as $recepte)
                    @if ($recepte->id % 2 == 1 and $recepte->ispublic == true)
                        <div class="card m-2">
                            @if (RecipeImages::find($recepte->id)->imageurl)
                                <img src="{{ RecipeImages::find($recepte->id)->imageurl}}" class="card-img-top" alt="..." style="height: 300px">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title mb-1">{{ $recepte->title }}</h5>
                                <h5 class="card-title">{{ Users::find($recepte->userid)->name }}</h5>
                                <p class="card-text" style="max-height: 200px; overflow: hidden">{{ $recepte->desc }}</p>
                                <button type="button" class="d-inline btn btn-outline-danger">Patīk</button>
                                <button type="button" class="d-inline btn btn-outline-danger ml-1">Saglabāt</button> 
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>
@endsection