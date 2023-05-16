<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class SignupController extends Controller
{
    // show signup view
    public function create(): Response
    {
        return Inertia::render('Auth/Signup');
    }

    // sign up the user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/');
    }
}
