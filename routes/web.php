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

// // candidate
// Route::get('/candidate', [CandidateController::class, 'index']);

Route::get('/candidate', [CandidateController::class, 'index'])->name('candidates.index');
Route::get('/get-candidates', [CandidateController::class, 'getCandidates'])->name('candidates.list');
Route::delete('/candidates/{id}', [CandidateController::class, 'destroy'])->name('candidates.destroy');

// Optional Edit & Create routes
Route::get('/candidates/create', [CandidateController::class, 'create'])->name('candidates.create');
Route::get('/candidates/{id}/edit', [CandidateController::class, 'edit'])->name('candidates.edit');

