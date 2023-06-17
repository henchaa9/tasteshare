<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipes;

class RecepteController extends Controller
{
    public function saglabatRecepti(Request $request)
    {
        $newRecipe = new Recipes;
        $newRecipe->title = $request->nosaukums;
        $newRecipe->desc = $request->apraksts;
        $newRecipe->preptime = $request->sagatavosanasLaiks;
        $newRecipe->cooktime = $request->pagatavosanasLaiks;
        $newRecipe->servings = $request->porcijas;
        $newRecipe->instructions = $request->pagatavosana;
        $newRecipe->upvotes = 0;
        $newRecipe->ispublic = 0;
        $newRecipe->userid = $request->user()->id;
        $newRecipe->save();


        return view('welcome');
    }
}
