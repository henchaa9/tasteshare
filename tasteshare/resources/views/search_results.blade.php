@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Meklēšanas rezultāti</h3>

        <p>Atslēgas vārds: "{{ $query }}"</p>

        @if ($results->isEmpty())
            <p>Nav rezultātu.</p>
        @else
            <div class="row">
                @foreach ($results as $result)
                    <div class="col-lg-6" style="max-width: 500px">
                        <div class="card m-2">
                            @php
                                $recipeImage = App\Models\RecipeImages::where('recipeid', $result->id)->first();
                                $userName = $result->user->name; // Access the user name
                            @endphp
                            @if ($recipeImage)
                                <img src="{{ $recipeImage->imageurl }}" class="card-img-top" alt="Recipe Image" style="height: 300px">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ route('recepte', ['id' => $result->id]) }}" class="text-dark">{{ $result->title }}</a>
                                </h4>
                                <h5 class="card-text">Autors: {{ $userName }}</h5> <!-- Display the user name -->
                                <p class="card-text">{{ $result->desc }}</p>
                                <p class="card-text">Sagatavošanas laiks: {{ $result->preptime }} minūtes</p>
                                <p class="card-text">Gatavošanas laiks: {{ $result->cooktime }} minūtes</p>
                                <p class="card-text">Porciju skaits: {{ $result->servings }}</p>
                                <!-- Additional recipe details here -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

