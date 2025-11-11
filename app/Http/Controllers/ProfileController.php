<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(){
        $user = User::where('id', Auth::id())->first();

        return view('users.profile', compact('user'));
    }

    public function updateAvatar(Request $request){

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|'
        ]);
        $imagePath = $request->file('image')->store('images', 'public');

        $user = Auth::user();

        if (!$user->profile){
            $user->profile()->create(['image' => $imagePath]);
        } else {
           $user->profile()->update(['image' => $imagePath]);
        }

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}
