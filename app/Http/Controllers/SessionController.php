<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class SessionController extends Controller
{
    public function create(): View {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse {

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)){
            if (Auth::user()->is_admin === 1) {
                $request->session()->regenerate();

                return redirect()->route('admin.dashboard');
            } else {
                $request->session()->regenerate();

                return redirect()->route('index');
            }
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials.'
        ]);
    }

    public function destroy(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
