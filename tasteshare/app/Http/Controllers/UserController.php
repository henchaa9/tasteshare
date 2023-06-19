<?php

namespace App\Http\Controllers;
use App\Models\Recipes;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

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

    public function destroy(Request $request)
{
    // Verify password and perform deletion
    $password = $request->input('password');

    if (!Hash::check($password, $request->user()->password)) {
        // Password does not match, handle the error
        return back()->withErrors(['password' => 'Nepareiza parole']);
    }

    // Password is correct, proceed with deletion
    // Delete the user's recipes
    $user = $request->user();
    $user->recipes()->delete();

    // Delete the user account
    $user->delete();

    // Perform any additional actions (e.g., logging out the user)

    // Redirect the user to a confirmation page or any other desired location
    return redirect()->route('account.deleted');
}


    public function confirmDelete()
    {
        return view('account-delete');
    }


}


