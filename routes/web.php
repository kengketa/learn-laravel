<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/cherry', function () {
    return Inertia::render('Cherry');
});
Route::get('/jed', function () {
    return Inertia::render('Jed');
});

Route::get('/amnat', function () {
    return Inertia::render('Jed');
});

Route::get('/dod', function () {
    return Inertia::render('Dod');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        $users = \App\Models\User::paginate(5);
        $userData = fractal($users, new \App\Transformers\UserTransformer())->toArray();
        dd($userData);
    })->name('dashboard');
});
