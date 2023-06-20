<?php

namespace App\Http\Controllers;

use App\Models\Recipes;
use App\Models\RecipeImages;
use App\Models\Upvotes;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Favourites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Model;

class UserController extends Controller
{


    // atjaunot profilu

    public function edit()
    {
    $user = Auth::user();
    return view('update-profile', ['user' => $user]);
    }


    public function profile()
    {
        $user = Auth::user();
        $receptes = Recipes::where('userid', $user->id)->get();

        return view('profile', compact('user', 'receptes'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->back()->with('success', 'Profils veiksmīgi atjaunots.');

    }


// dzēst profilu



public function destroy(Request $request)
{   
    // Verify password and perform deletion
    $password = $request->input('password');

    if (!Hash::check($password, $request->user()->password)) {
        // Password does not match, handle the error
        return back()->withErrors(['password' => 'Nepareiza parole']);
    }

    // Password is correct, proceed with deletion

    // Delete the user's favorites
    // Delete the user's favorites
    $deletedFavorites = Favourites::where('userid', $request->user()->id)->get();
    $deletedFavoritesCount = $deletedFavorites->count();

    // Delete the favorites
    Favourites::where('userid', $request->user()->id)->delete();

    // Display a message with the number of deleted favorites
    $message = 'Deleted ' . $deletedFavoritesCount . ' favorites.';
    dump($message);

    // Delete the user's upvotes
    Upvotes::where('userid', $request->user()->id)->delete();

    // Delete the user's recipes and associated images
    $recipes = Recipes::where('userid', $request->user()->id)->get();

    foreach ($recipes as $recipe) {
        // Delete the associated pictures
        $recipeImages = RecipeImages::where('recipeid', $recipe->id)->get();

        foreach ($recipeImages as $image) {
            $image->delete();
        }

        // Delete the recipe
        $recipe->delete();
    }

    // Delete the user account
    $request->user()->delete();

    // Flash a success message to the session
    Session::flash('success', 'Jūsu konts ir veiksmīgi dzēsts.');

    // Redirect the user to the main page
    return redirect('/');
}







    // apstiprināt profila izdzēšanu

    public function confirmDelete()
{
        return view('account-delete');
}


    
    // dzēst recepti
    

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



// Publiska user profila recepšu saņemšanai

public function publicProfile($name)
{
    $user = User::where('name', $name)->first();

    if ($user) {
        $recipes = $user->recipes()
            ->where('ispublic', true)
            ->get();

        return view('public-profile', compact('user', 'recipes'));
    } else {
        abort(404); // User not found
    }
}






public function profileRecipe()
{
    $user = Auth::user();
    $recipes = Recipes::where('id', $user->id)->get();

    if ($recipes === null || $recipes->isEmpty()) {
        $recipes = collect(); // Create an empty collection if $receptes is null or empty
    }

    return view('profile', compact('user', 'receptes'));
}




}


