<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipes;
use App\Models\RecipeImages;

class RecepteController extends Controller
{
    public function index()
    {
        return view('welcome', ['receptes' => Recipes::all()]);
    }

    public function manasreceptes()
    {
        return view('manasreceptes', ['receptes' => Recipes::all()]);
    }

    public function raditrecepti($id)
    {
        return view('recepte', ['receptes' => Recipes::find($id)]);
    }

    public function redigetview($id)
    {
        return view('rediget', ['receptes' => Recipes::find($id)]);
    }

    public function saglabatRecepti(Request $request)
    {
        $newRecipe = new Recipes;
        $newRecipe->title = $request->nosaukums;
        $newRecipe->desc = $request->apraksts;
        $newRecipe->preptime = $request->sagatavosanasLaiks;
        $newRecipe->cooktime = $request->pagatavosanasLaiks;
        $newRecipe->servings = $request->porcijas;
        $newRecipe->instructions = $request->pagatavosana;
        $newRecipe->ispublic = 0;
        $newRecipe->userid = $request->user()->id;
        $newRecipe->save();

        $newPhoto = new RecipeImages;
        $newPhoto->recipeid = $newRecipe->id;
        $newPhoto->imageurl = $request->foto ?? 'https://cdn-icons-png.flaticon.com/512/2771/2771401.png';
        $newPhoto->save();


        return redirect('');
    }

    public function redigetRecepti($id, Request $request)
    {
        $rrecepte = Recipes::find($id);
        $rrecepte->title = $request->input('nosaukums');
        $rrecepte->desc = $request->input('apraksts');
        $rrecepte->preptime = $request->input('sagatavosanasLaiks');
        $rrecepte->cooktime = $request->input('pagatavosanasLaiks');
        $rrecepte->servings = $request->input('porcijas');
        $rrecepte->instructions = $request->input('pagatavosana');
        $rrecepte->save();

        $recipeImage = RecipeImages::where('recipeid', $id)->first();
        if ($recipeImage) {
            $recipeImage->imageurl = $request->input('foto') ?? 'https://cdn-icons-png.flaticon.com/512/2771/2771401.png';
            $recipeImage->save();
        }

        return redirect('/');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Recipes::where('title', 'like', "%$query%")
                         ->orWhere('desc', 'like', "%$query%")
                         ->orWhere('instructions', 'like', "%$query%")
                         ->with('user') // Load the user information for each recipe
                         ->get();
    
        $imageUrls = RecipeImages::whereIn('recipeid', $results->pluck('id'))->pluck('imageurl', 'recipeid');
    
        return view('search_results', compact('results', 'query', 'imageUrls'));
    }
    
    
}
