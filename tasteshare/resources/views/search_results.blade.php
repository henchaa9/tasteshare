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
                                @if (Auth::check())
                                    @if ($result->userid == Auth::id())
                                    <div class="btn-group">
                                        <a type="button" class="d-inline btn btn-warning" href="rediget/{{ $result->id }}">Rediģēt</a>
                                        <form method="POST" action="{{ route('delete', ['id' => $result->id]) }}" onsubmit="return confirm('Vai esat pārliecināts, ka vēlaties dzēst šo recepti?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger ml-2">Dzēst</button>
                                        </form>
                                    </div>
                                    @else
                                    <div id="upvote-button-{{ $result->id }}" class="btn-group" data-toggle="buttons">

                                        <form id="favorites-form-{{ $result->id }}" action="{{ route('recipes.favorites.save', $result) }}" method="POST">
                                            {{ csrf_field() }}
                                            @method('PUT')
                                            <button type="button" onclick="handleFavorite({{ $result->id }})" class="d-inline btn {{ $result->favoritedByUser() ? 'btn-warning' : 'btn-outline-warning' }}">
                                                @if ($result->favoritedByUser())
                                                    Saglabāta
                                                @else
                                                    Saglabāt
                                                @endif
                                            </button>
                                        </form>
                                        <form id="upvote-form-{{ $result->id }}" action="{{ route('recipes.upvote', $result) }}" method="POST">
                                            {{ csrf_field() }}
                                            @if ($result->isUpvotedByUser())
                                                @method('DELETE')
                                            @endif
                                            <button type="button" onclick="handleUpvote({{ $result->id }})" class="d-inline btn ml-1 {{ $result->isUpvotedByUser() ? 'btn-danger' : 'btn-outline-danger' }}">Patīk {{ $result->upvotes_count }}</button>
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

