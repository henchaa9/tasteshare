@extends('layouts.app')

@section('content')
    <div class="container">
    <h2>Lietotāja <u>{{ $user->name }}</u> receptes</h2>
    </div>

    <div class="container mt-3">
        @if ($recipes->count() > 0)
            <div class="row">
                @foreach ($recipes as $recipe)
                    <div class="col-md-6">
                        <div class="card m-2">
                            @php
                                $recipeImage = App\Models\RecipeImages::where('recipeid', $recipe->id)->first();
                            @endphp
                            @if ($recipeImage)
                                <img src="{{ $recipeImage->imageurl }}" class="card-img-top" alt="Recipe Image" style="height: 300px">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title mb-1">
                                    <a href="{{ route('recepte', ['id' => $recipe->id]) }}" class="text-dark">{{ $recipe->title }}</a>
                                </h4>
                                <p class="card-text">{{ $recipe->desc }}</p>
                                <p class="card-text">Sagatavošanas laiks: {{ $recipe->preptime }} min</p>
                                <p class="card-text">Gatavošanas laiks: {{ $recipe->cooktime }} min</p>
                                <p class="card-text">Porciju skaits: {{ $recipe->servings }}</p>
                                <!-- Display other recipe details -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Lietotājs nav izveidojis nevienu recepti.</p>
        @endif
    </div>
@endsection

