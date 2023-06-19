@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Profils</h2>
        <p>Vārds: {{ $user->name }}</p>
        <p>E-pasts: {{ $user->email }}</p>
        <!-- Add more user profile information here -->

        <a href="{{ route('profile.edit') }}" class="btn btn-warning">Atjaunināt profilu</a>
        <a href="{{ route('profile.confirmDelete') }}" class="btn btn-danger">Dzēst kontu</a>
    </div>

    <div class="container">
        <p>
        <h2>Manas receptes</h2>
        <div class="row">
            @if (count($receptes) == 1)
                <div class="col" style="max-width: 550px">
                    <div class="card m-2">
                        @php
                            $recepte = $receptes[0];
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
                            <h5 class="card-title">{{ $userName }}</h5>
                            <p class="card-text" style="max-height: 200px; overflow: hidden">{{ $recepte->desc }}</p>
                            <a type="button" class="d-inline btn btn-warning" href="rediget/{{ $recepte->id }}">Rediģēt</a>
                            <button type="button" class="d-inline btn btn-danger ml-1">Dzēst</button>
                        </div>
                    </div>
                </div>
            @else
                <div class="col" style="max-width: 550px">
                    @foreach ($receptes as $recepte)
                        @if ($recepte->id % 2 == 1 && $recepte->userid == Auth::id())
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
                                    <h5 class="card-title">{{ $userName }}</h5>
                                    <p class="card-text" style="max-height: 200px; overflow: hidden">{{ $recepte->desc }}</p>
                                    <a type="button" class="d-inline btn btn-warning" href="rediget/{{ $recepte->id }}">Rediģēt</a>
                                    <button type="button" class="d-inline btn btn-danger ml-1">Dzēst</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="col" style="max-width: 550px">
                    @foreach ($receptes as $recepte)
                        @if ($recepte->id % 2 == 0 && $recepte->userid == Auth::id())
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
                                    <h5 class="card-title">{{ $userName }}</h5>
                                    <p class="card-text" style="max-height: 200px; overflow: hidden">{{ $recepte->desc }}</p>
                                    <a type="button" class="d-inline btn btn-warning" href="rediget/{{ $recepte->id }}">Rediģēt</a>
                                    <button type="button" class="d-inline btn btn-danger ml-1">Dzēst</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
        </p>
    </div>
@endsection

