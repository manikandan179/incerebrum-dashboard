<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UpskillsController;


Route::post('/upskills', [UpskillsController::class, 'Create']);