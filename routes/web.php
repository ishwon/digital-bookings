<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return view('home');
})->name('home');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('login.store');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/status', function () {
    return response()->json(['status' => 'ok']);
})->name('echo');
