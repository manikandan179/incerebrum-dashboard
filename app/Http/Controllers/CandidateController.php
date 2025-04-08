<?php

namespace App\Http\Controllers;
use App\Models\CandidateModel;

use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidate = CandidateModel::all();
        return view('candidate.candidate-listing', compact('candidate'));
    }
}
