<?php
namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\RecipeImages;
use App\Models\Recipes;
use App\Models\Upvote;
use Redirect;

use Illuminate\Http\Request;

class UpvoteController extends Controller
{
    //

    public function upvote(Request $request, Recipes $recepte)
    {
        if ($request->isMethod('delete')) {
            // User wants to remove the upvote
            $upvote = Upvote::where('userid', auth()->id())
                ->where('recipeid', $recepte->id)
                ->first();
    
            if ($upvote) {
                $upvote->delete();
            }
        } else {
            // User wants to upvote the recipe
            $upvote = Upvote::where('userid', auth()->id())
                ->where('recipeid', $recepte->id)
                ->first();
    
            if (!$upvote) {
                $upvote = new Upvote();
                $upvote->userid = auth()->id();
                $upvote->recipeid = $recepte->id;
                $upvote->save();
            }
        }
    
        return Redirect::back();
    }
    

}
