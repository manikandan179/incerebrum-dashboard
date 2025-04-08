<?php

namespace App\Http\Controllers;
use App\Models\CandidateModel;

use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidate = CandidateModel::all();
        return view('candidate.index', compact('candidate'));
    }

    public function getCandidates(Request $request)
    {
        if ($request->ajax()) {
            $data = CandidateModel::select(['id', 'name', 'email', 'phone', 'created_at']);

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editUrl = route('candidates.edit', $row->id);
                    return '
                        <a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
                        <button onclick="deleteCandidate('.$row->id.')" class="btn btn-sm btn-danger">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    }


    

