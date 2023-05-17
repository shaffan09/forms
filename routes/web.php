<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
   return redirect('/forms');
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
    Route::get('/forms', [FormController::class, 'index']);

    // show create form page
    Route::get('/forms/create', [FormController::class, 'create']);

    // store form
    Route::post('/forms/create', [FormController::class, 'store']);
});
