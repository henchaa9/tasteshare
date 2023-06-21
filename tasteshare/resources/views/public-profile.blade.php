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
                                @if (Auth::check())
                                    @if ($recipe->userid == Auth::id())
                                    <div class="btn-group">
                                        <a type="button" class="d-inline btn btn-warning" href="rediget/{{ $recipe->id }}">Rediģēt</a>
                                        <form method="POST" action="{{ route('delete', ['id' => $recipe->id]) }}" onsubmit="return confirm('Vai esat pārliecināts, ka vēlaties dzēst šo recepti?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger ml-2">Dzēst</button>
                                        </form>
                                    </div>
                                    @else
                                    <div id="upvote-button-{{ $recipe->id }}" class="btn-group" data-toggle="buttons">

                                        <form id="favorites-form-{{ $recipe->id }}" action="{{ route('recipes.favorites.save', $recipe) }}" method="POST">
                                            {{ csrf_field() }}
                                            @method('PUT')
                                            <button type="button" onclick="handleFavorite({{ $recipe->id }})" class="d-inline btn {{ $recipe->favoritedByUser() ? 'btn-warning' : 'btn-outline-warning' }}">
                                                @if ($recipe->favoritedByUser())
                                                    Saglabāta
                                                @else
                                                    Saglabāt
                                                @endif
                                            </button>
                                        </form>
                                        <form id="upvote-form-{{ $recipe->id }}" action="{{ route('recipes.upvote', $recipe) }}" method="POST">
                                            {{ csrf_field() }}
                                            @if ($recipe->isUpvotedByUser())
                                                @method('DELETE')
                                            @endif
                                            <button type="button" onclick="handleUpvote({{ $recipe->id }})" class="d-inline btn ml-1 {{ $recipe->isUpvotedByUser() ? 'btn-danger' : 'btn-outline-danger' }}">Patīk {{ $recipe->upvotes_count }}</button>
                                        </form>
                                    </div>
                                    @endif
                                @else
                                    <a type="button" class="d-inline btn btn-outline-danger" href="login">Patīk</a>
                                    <a type="button" class="d-inline btn btn-outline-danger ml-1" href="login">Saglabāt</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Lietotājs nav izveidojis nevienu recepti.</p>
        @endif
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
@endsection

