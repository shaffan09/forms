<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    // route to store new user
    public function store(Request $request, Form $form)
    {
        $responseForm = $request->validate([
            'field_values' => ['required'],
        ]);

//        $response = new Response($responseForm);
//        $response->form()->associate($form)->save();
        $form->responses()->create($responseForm);

        return redirect('/');
    }
}
