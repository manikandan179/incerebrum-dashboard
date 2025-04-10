<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CandidateModel;
use Illuminate\Support\Facades\Hash;

class CandidateController extends Controller
{
    // Show the list view
    public function index()
    {
        return view('candidate.index');
    }

    // DataTables AJAX fetch
    public function getCandidates(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start') ?? 0;
        $length = $request->get('length') ?? 10;
        $search = $request->input('search.value');

        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        $totalRecords = $query->count();

        $candidates = $query->orderBy('created_at', 'desc')
                            ->where('role','STUDENT')
                            ->skip($start)
                            ->take($length)
                            ->get();

        $data = [];
        foreach ($candidates as $candidate) {
            $editUrl = route('candidates.edit', $candidate->id);
            $data[] = [
                'name'       => $candidate->name,
                'email'      => $candidate->email,
                'phone'      => $candidate->phone,
                'created_at' => $candidate->created_at->format('Y-m-d H:i:s'),
                'action'     => '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger" onclick="deleteCandidate(' . $candidate->id . ')">Delete</button>
                ',
            ];
        }

        return response()->json([
            'draw'            => intval($draw),
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data'            => $data,
        ]);
    }

    // Show create form
    public function create()
    {
       
        return view('candidate.create-edit');
    }

    // Store new candidate
    public function store(Request $request)
    {
        $validatedUser = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
        ]);
        $validatedUser['password'] = Hash::make('123456');
        $user = User::create($validatedUser);
    
        // Create candidate record
        $candidateData = $request->only([
            'dob',
            'nationality',
            'address',
            'highest_qualification',
            'institution_name',
            'course_name',
            'year_of_completion',
            'certificates',
            'preferred_start_date',
            'specializations',
            'work_experience',
            'reason_for_joining',
            'special_fequirements'
        ]);
        $candidateData['user_id'] = $user->id;
    
        \App\Models\CandidateModel::create($candidateData);
    
        return redirect()->route('candidates.index')->with('success', 'Student created successfully.');
    }
    

    // Show edit form (reusing same form)
    public function edit($id)
    {
        $candidate = User::findOrFail($id);
        return view('candidate.create-edit', compact('candidate'));
    }

    // Update existing candidate
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validate User fields
        $validatedUser = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
        ]);
    
        // Update User
        $user->update($validatedUser);
    
        // Update CandidateModel using user_id
        $candidate = CandidateModel::where('user_id', $user->id)->first();
    
        if ($candidate) {
            $candidateData = $request->only([
                'dob',
                'nationality',
                'address',
                'highest_qualification',
                'institution_name',
                'course_name',
                'year_of_completion',
                'certificates',
                'preferred_start_date',
                'specializations',
                'work_experience',
                'reason_for_joining',
                'special_fequirements'
            ]);
    
            $candidate->update($candidateData);
        }
    
        return redirect()->route('candidates.index')->with('success', 'Student updated successfully.');
    }
    

    // Delete candidate (AJAX)
    public function destroy($id)
    {
        $candidate = User::findOrFail($id);
        $candidate->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Student deleted successfully.',
        ]);
    }
}
