<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function create(): View {
        return view('auth.register');
    }
}
