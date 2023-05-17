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

//        $formData['fields'] = json_encode($formData['fields']);

        $form = new Form($formData);
        $form->user()->associate(auth()->user())->save();

        return redirect('/forms');
    }
}
