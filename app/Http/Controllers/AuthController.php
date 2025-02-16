<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     // Show registration form
     public function showRegistrationForm()
     {
         return view('Roles.register');
     }
 
     // Handle registration logic
     public function register(Request $request)
     {
         $request->validate([
             'username' => 'required|string|max:255',
             'email' => 'required|email|unique:admins,email',
             'password' => 'required|string|min:6|confirmed',
         ]);
 
         $admin = Admin::create([
             'username' => $request->username,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);
 
         return redirect()->route('login')->with('success', 'Registration successful, please log in!');
     }
 
     // Show login form
     public function showLoginForm()
     {
         return view('Roles.login');
     }
 
     // Handle login logic
     public function login(Request $request)
     {
         $request->validate([
             'username' => 'required|string',
             'password' => 'required|string',
         ]);
 
         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
             return redirect()->route('dashboard');
         } else {
             return back()->withErrors(['email' => 'The credentials do not match our records.']);
         }
     }
 
     // Handle logout logic
     public function logout()
     {
         Auth::logout();
         return redirect()->route('login');
     }
}
