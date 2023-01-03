<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;


Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('login');

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return Inertia::render('Welcome');
    });
});

Route::get('/users', function () {
    $user = Auth::user();
    return Inertia::render('Users/Index', [
        'users' => \App\Models\User::query()
        ->when(Request::input('search'), function($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->paginate(10)
        ->withQueryString()
        ->through(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
        ]),
        'filters' => Request::only(['search']),
        'can' => [
            'createUser' => Auth::user()->can('edit', $user)
        ]
    ]);
});

Route::post('/users', function () {
    sleep(3);
    //  validate the request
    $validated = Request::validate([
        'name' => 'required',
        'email' => ['required', 'email'],
        'password' => 'required', 
    ]);

    //  create the user
    $user = new \App\Models\User;
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->password = $user->setPasswordAtrribute($validated['password']);
    $user->stripe_token = 12345;
    $user->save();

    //  redirect
    return redirect('/users');
});

Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
});

Route::get('/settings', function () {
    return Inertia::render('Settings');
});
