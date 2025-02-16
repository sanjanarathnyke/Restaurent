<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillController extends Controller
{
    public function showBill()
    {
        return view('bill'); // This will return the bill view
    }
}
