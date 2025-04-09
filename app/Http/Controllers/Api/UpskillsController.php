<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upskill;
use Illuminate\Support\Facades\Validator;

class UpskillsController extends Controller
{
    public function Create(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'name'    => 'required|max:191',
                'email'   => 'required|email|max:191|unique:upskill,email',
                'phone'   => 'required|max:191',
                'message' => 'required|max:191',
            ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'error' => $validator->errors()], 422);
        }
        $upskill=Upskill::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'message' => $request->message,
        ]);
        
        return response()->json(['status' => true,'message' => 'Upskill created successfully!']);
    }

}
