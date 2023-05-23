<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ResponseController extends Controller
{
    public function show(Form $form): InertiaResponse
    {
        return Inertia::render('Response/View', [
            'responses' => Response::query()->where('form_id', $form->id)->get(),
            'form_title' => $form->title,
        ]);
    }

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
