<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ResponseController;
use App\Models\Form;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home page
Route::get('/', function () {
    return redirect('/my/forms');
});

//Auth routes

//show signup form
Route::get('/signup', [SignupController::class, 'create'])->middleware('guest');

//signup the user
Route::post('/signup', [SignupController::class, 'store']);

//show login form
Route::get('/login', [LoginController::class, 'create'])->name('login')->middleware('guest');

//login the user
Route::post('/authenticate', [LoginController::class, 'store']);

//logout
Route::post('/logout', [LoginController::class, 'destroy']);

//-------------------------------------------------------------

//Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/my/forms', [FormController::class, 'index']);

    // show create form page
    Route::get('/my/forms/create', [FormController::class, 'create']);

    // store form
    Route::post('/my/forms/create', [FormController::class, 'store']);

    // show edit form page
    Route::get(
        '/my/forms/{form}/edit',
        [FormController::class, 'edit']
    )->can('update', 'form');

    // route to update form
    Route::post(
        '/my/forms/{form}/edit',
        [FormController::class, 'update']
    )->can('update', 'form');

    // route to delete the form
    Route::delete(
        '/my/forms/{form}',
        [FormController::class, 'destroy'],
    )->can('delete', 'form');

    // show responses for the form
    Route::get('/my/forms/{form}/response', [ResponseController::class, 'show']);
});

// show single form for response
Route::get('/forms/{form}', [FormController::class, 'show']);

// route to store response
Route::post('/forms/{form}/response', [ResponseController::class, 'store']);
