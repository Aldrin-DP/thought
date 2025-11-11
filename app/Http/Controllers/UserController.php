<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function store(Request $request): RedirectResponse {
        $validated = $request->validate([
            'firstname' => ['required', 'min:2', 'max:100', 'string'],
            'lastname' => ['required', 'min:2', 'max:100', 'string'],
            'gender' => ['required'],
            'email' => ['required', 'email', 'string', 'max:100', 'unique:users,email'],
            'password' => ['required', Password::defaults()]
        ]);
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('login');
    }

    public function showProfile(){

    }
}

