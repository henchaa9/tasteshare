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
                    <div class="col-lg-6" style="max-width: 550px">
                        <div class="card m-2">
                            @php
                                $recipeImage = App\Models\RecipeImages::where('recipeid', $result->id)->first();
                                $userName = $result->user->name; // Access the user name
                            @endphp
                            @if ($recipeImage)
                                <img src="{{ $recipeImage->imageurl }}" class="card-img-top" alt="Recipe Image" style="height: 300px">
                            @endif
                            <div class="card-body">
                            <a href="{{ route('recepte', ['id' => $result->id]) }}" class="text-dark"><h4 class="card-title mb-1">{{ $result->title }}</h4></a>

                                <h6 class="card-title">Autors: <a href="{{ route('public-profile', ['name' => $userName]) }}" class="text-dark">{{ $userName }}</h6></a>
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

