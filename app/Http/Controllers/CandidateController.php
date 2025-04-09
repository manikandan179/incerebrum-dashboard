<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
        ]);

        User::create($validated);

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
        $candidate = User::findOrFail($id);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $candidate->id,
            'phone' => 'required|string|max:20',
        ]);

        $candidate->update($validated);

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
