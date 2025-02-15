<?php

namespace App\Http\Controllers;

use App\Models\BookingTable;
use Illuminate\Http\Request;

class BookingTableController extends Controller
{
   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'people' => 'required|string',
            'time' => 'required|string',
            'date' => 'required|string',
            'description' => 'nullable|string',
        ]);

        BookingTable::create($request->all());
        
        return redirect()->back()->with('success', 'Table booked successfully!');
    }

    
}
