<?php
namespace App\Http\Controllers;

use App\Models\Recipes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Redirect;

class FavoritesController extends Controller
{

    public function index(Request $request)
    {
        $receptes = Recipes::withCount('upvotes')->get();
        return view('favorites', ['receptes' => $receptes]);
    }


    public function save(Request $request, Recipes $recepte)
    {
        $user = Auth::user();

        if ($user->favorites()->where('recipeid', $recepte->id)->exists()) {
            // Recipe already saved, so remove it from favorites
            $user->favorites()->detach($recepte);
        } else {
            // Recipe not saved, so add it to favorites
            $user->favorites()->attach($recepte, ['recipeid' => $recepte->id]);
        }

        return Redirect::back();
    }
}
