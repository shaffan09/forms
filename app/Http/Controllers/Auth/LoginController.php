<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    //show login form
    public function create(): Response
    {
        return Inertia::render('Auth/Login');
    }

    //log the user in
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors(['email' => 'Invalid Credentials!'])->onlyInput('email');
    }

    //logout
    public function destroy(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
