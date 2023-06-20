<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Recipes;
use App\Models\RecipeImages;


class RecepteController extends Controller
{
    public function index()
{
    $receptes = Recipes::withCount('upvotes')->get();
    return view('welcome', compact('receptes'));
}


    public function manasreceptes()
    {
        $userId = Auth::id();
        $receptes = Recipes::where('userid', $userId)->get();
        return view('manasreceptes', ['receptes' => $receptes]);
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
        $newRecipe->ispublic = $request->has('ispublic') ? 1 : 0; // Set ispublic based on checkbox
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
        $rrecepte->ispublic = $request->has('ispublic') ? 1 : 0; // Set ispublic based on checkbox
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
    
    public function delete($id)
    {
        $recipe = Recipes::find($id);
    
        if (!$recipe) {
            return redirect()->back()->with('error', 'Recepte nav atrasta.');
        }
    
        // Check if the authenticated user has permission to delete the recipe
        if ($recipe->userid != Auth::id()) {
            return redirect()->back()->with('error', 'Jums nav atļaujas dzēst šo recepti.');
        }
    
        // Delete the associated picture
        $recipeImage = RecipeImages::where('recipeid', $id)->first();
    
        if ($recipeImage) {
            // Delete the recipe image
            $recipeImage->delete();
        }
        // Delete the recipe
        $recipe->delete();
    
        return redirect()->back()->with('success', 'Recepte ir veiksmīgi dzēsta.');
    }
    
}
