<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\TempPasswordMail;

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

        $user = User::where(['email'=> $request->email,'role'=>'ADMIN'])->first();

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

    public function sendTempPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found.'], 404);
        }

        $tempPassword = mt_rand(100000, 999999);
        $user->password = Hash::make($tempPassword);
        $user->save();

        Mail::to($user->email)->send(new TempPasswordMail($user, $tempPassword));

        return response()->json(['message' => 'Temporary password sent to your email.']);
    }

    // Logout
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
