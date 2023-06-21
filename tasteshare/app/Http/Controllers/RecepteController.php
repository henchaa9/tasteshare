<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Recipes;
use App\Models\RecipeImages;
use Illuminate\Support\Facades\Storage;


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
        $upvotes_count = Recipes::withCount('upvotes')->get();
        return view('recepte', ['receptes' => Recipes::find($id), 'upvotes_count' => $upvotes_count]);
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
        $newRecipe->ispublic = $request->has('ispublic') ? 1 : 0;
        $newRecipe->userid = $request->user()->id;
        $newRecipe->save();
    
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('public/recepti');
            $imageUrl = Storage::url($imagePath);
        } else {
            $imageUrl = $request->input('foto') ?? 'https://cdn-icons-png.flaticon.com/512/2771/2771401.png';
        }
    
        $newPhoto = new RecipeImages;
        $newPhoto->recipeid = $newRecipe->id;
        $newPhoto->imageurl = $imageUrl;
        $newPhoto->save();
    
        return redirect('/manasreceptes');
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
        $rrecepte->ispublic = $request->has('ispublic') ? 1 : 0;
        $rrecepte->save();
    
        $recipeImage = RecipeImages::where('recipeid', $id)->first();
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('public/recepti');
            $imageUrl = Storage::url($imagePath);
            $recipeImage->imageurl = $imageUrl;
        }
        $recipeImage->save();
    
        return redirect('/');
    }
    
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     $results = Recipes::where('title', 'like', "%$query%")
    //                      ->orWhere('desc', 'like', "%$query%")
    //                      ->orWhere('instructions', 'like', "%$query%")
    //                      ->with('user') // Load the user information for each recipe
    //                      ->get();
    
    //     $imageUrls = RecipeImages::whereIn('recipeid', $results->pluck('id'))->pluck('imageurl', 'recipeid');
    
    //     // return view('search_results', compact('results', 'query', 'imageUrls'));

    //     $upvotes_count = Recipes::withCount('upvotes')->get();

    //     return view('search_results', [
    //         'results' => $results,
    //         'query' => $query,
    //         'imageUrls' => $imageUrls,
    //         'upvotes_count' => $upvotes_count
    //     ]);

    // }
    public function search(Request $request)
{
    $query = $request->input('query');
    
    $results = Recipes::where('title', 'like', "%$query%")
                     ->orWhere('desc', 'like', "%$query%")
                     ->orWhere('instructions', 'like', "%$query%")
                     ->with('user') // Load the user information for each recipe
                     ->get();
    
    $imageUrls = RecipeImages::whereIn('recipeid', $results->pluck('id'))->pluck('imageurl', 'recipeid');
    
    $upvotes_count = $results->loadCount('upvotes');
    
    return view('search_results', [
        'results' => $results,
        'query' => $query,
        'imageUrls' => $imageUrls,
        'upvotes_count' => $upvotes_count
    ]);
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
