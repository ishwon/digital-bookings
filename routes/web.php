<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SalespersonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (! Auth::check()) {
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

Route::resource('salespeople', SalespersonController::class)->except(['show']);

Route::resource('agencies', AgencyController::class);

Route::resource('clients', ClientController::class);

Route::get('/status', function () {
    return response()->json(['status' => 'ok']);
})->name('echo');
