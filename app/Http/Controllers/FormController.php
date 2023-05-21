<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FormController extends Controller
{
    // show home page with user forms paginated
    public function index(): Response
    {
        return Inertia::render('Form/Index', [
            'forms' => Form::query()
                ->where('user_id', auth()->user()->id)
                ->orderByDesc('created_at')
                ->paginate(6),
        ]);
    }

    // show single form to send a response
    public function show(Form $form): Response
    {
        return Inertia::render('Form/View', [
            'form' => $form
        ]);
    }

    //show create form page
    public function create(): Response
    {
        return Inertia::render('Form/Create');
    }

    //store the form data
    public function store(Request $request)
    {
        $formData = $request->validate([
            'title' => ['required'],
            'description' => [],
            'is_active' => ['required'],
            'exp_date' => [],
            'fields' => ['required'],
        ]);

        $form = new Form($formData);
        $form->user()->associate(auth()->user())->save();

        return redirect('/my/forms');
    }

    //show edit form screen
    public function edit(Form $form): Response
    {
        $form['is_active'] =  (bool)$form['is_active'];

        return Inertia::render('Form/Edit', [
            'form' => $form,
        ]);
    }

    //update the form in the database
    public function update(Request $request, Form $form)
    {
        $formData = $request->validate([
            'title' => ['required'],
            'description' => [],
            'is_active' => ['required'],
            'exp_date' => [],
            'fields' => ['required'],
        ]);

        $form->update($formData);

        return redirect('/my/forms');
    }

    //delete the form from the database
    public function destroy(Form $form)
    {
        $form->delete();

        return redirect('/my/forms');
    }
}
