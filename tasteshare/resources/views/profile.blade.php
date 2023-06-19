@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Profils</h2>
        <p>Vārds: {{ $user->name }}</p>
        <p>E-pasts: {{ $user->email }}</p>
        <!-- Add more user profile information here -->

        <a href="{{ route('profile.edit') }}" class="btn btn-warning">Atjaunināt profilu</a>
        <a href="{{ route('profile.confirmDelete') }}" class="btn btn-danger">Dzēst kontu</a>
    </div >

    <div class="container" >
        <h2 class="mt-5">Lietotāja receptes</h2>
        <div class="row">
            @foreach ($receptes as $recepte)
                @if ($recepte->userid == Auth::id())
                    <div class="col-md-6">
                        <div class="card m-2">
                            @php
                                $recipeImage = App\Models\RecipeImages::join('Recipes', 'recipe_images.recipeid', '=', 'recipes.id')
                                    ->where('recipes.id', $recepte->id)
                                    ->select('recipe_images.imageurl')
                                    ->first();
                                $userName = App\Models\Users::find($recepte->userid)->name;
                            @endphp
                            @if ($recipeImage)
                                <img src="{{ $recipeImage->imageurl }}" class="card-img-top" alt="..." style="height: 300px">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title mb-1">
                                    <a href="{{ route('recepte', ['id' => $recepte->id]) }}" class="text-dark">{{ $recepte->title }}</a>
                                </h4>
                                <h6 class="card-title">Autors: {{ $userName }}</h6>
                                <p class="card-text" style="max-height: 200px; overflow: hidden">{{ $recepte->desc }}</p>
                                <p class="card-text">Sagatavošanas laiks: {{ $recepte->preptime }} minūtes</p>
                                <p class="card-text">Gatavošanas laiks: {{ $recepte->cooktime }} minūtes</p>
                                <p class="card-text">Porciju skaits: {{ $recepte->servings }}</p>
                                <a type="button" class="d-inline btn btn-warning" href="rediget/{{ $recepte->id }}">Rediģēt</a>
                                <button type="button" class="d-inline btn btn-danger ml-1">Dzēst</button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
