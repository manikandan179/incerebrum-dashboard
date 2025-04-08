<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;

Route::get('/', function () {
    return view('welcome');
});

// candidate
Route::get('/candidate', [CandidateController::class, 'index']);
