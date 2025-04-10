<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('/login'); // View at resources/views/login.blade.php
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

       if ($user && Hash::check($request->password, $user->password)) {
            // Set session values
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            Session::put('user_role', $user->role);
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
            ]);
        }
    
        return response()->json([
            'status' => false,
            'message' => 'Invalid email or password',
        ]);
    }

    // Logout
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
