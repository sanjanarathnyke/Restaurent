<?php

namespace App\Http\Controllers;

use App\Mail\BulkMail;
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
            'city' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
        ]);
    
        $consumer= Consumer::create($validated);

        Mail::to($consumer->email)->queue(new WelcomeMail($consumer->toArray()));
    
        return response()->json(['success' => true, 'message' => 'Data saved and email send successfully']);
    }

    public function Display()
    {
        $customers = Consumer::all();
        return view('eligiblecustomers',compact('customers'));
    }

    public function ViewPage()
    {
        return view('sendmails');
    }

    public function sendEmail(Request $request)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $subscribers = Consumer::distinct()->pluck('email');

    foreach ($subscribers as $email) {
        Mail::to($email)->queue(new BulkMail($request->message));
    }

    return back()->with('success', 'Email sent successfully to all subscribers.');
}

    
}
