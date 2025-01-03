<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Consumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConsumerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
        ]);
    
        $consumer= Consumer::create($validated);

        Mail::to($consumer->email)->send(new WelcomeMail($consumer->toArray()));
    
        return response()->json(['success' => true, 'message' => 'Data saved and email send successfully']);
    }
    
}
