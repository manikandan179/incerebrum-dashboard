<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UpskillController;

Route::get('/', function () {
    return view('welcome');
});


// Show login page
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/send-temp-password', [LoginController::class, 'sendTempPassword']);

Route::get('/get-candidates', [CandidateController::class, 'getCandidates'])->name('candidates.data');
Route::resource('candidates', CandidateController::class);

Route::get('/upskill', [UpskillController::class, 'index']);
Route::get('/get-upskills', [UpskillController::class, 'getUpskills'])->name('upskills.data');


