<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParticipantController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        return view('Roles.register');
    }
    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:participants,email',
            'password' => 'required|string|min:8',
        ]);

        // Determine role based on email domain
        $role = str_ends_with($request->email, '@admin.com') ? 'admin' : 'customer';

        // Create and save the participant
        Participant::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect()->route('login.form')->with('success', 'Registration successful. Please log in.');
    }
    // Show login form
    public function showLoginForm()
    {
        return view('Roles.login');
    }
    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $participant = Participant::where('email', $request->email)->first();

        if ($participant && Hash::check($request->password, $participant->password)) {
            return redirect()->route('welcome')->with('success', 'Login successful!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }
}
