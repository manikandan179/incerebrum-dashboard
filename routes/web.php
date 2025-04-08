<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CandidateController;

Route::get('/', function () {
    return view('welcome');
});


// Show login page
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    if (!session()->has('user_id')) {
        return redirect('/login')->with('error', 'Please login first');
    }
    return view('dashboard');
})->name('dashboard');

// candidate
Route::get('/candidate', [CandidateController::class, 'index']);
