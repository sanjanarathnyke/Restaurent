<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {   
        $itemNames = explode(',', $request->input('items'));
        $subtotal = $request->query('subtotal', 0);
        $shipping = $request->query('shipping', 0);
        $total = $request->query('total', 0);

        return view('checkout', compact('itemNames','subtotal', 'shipping', 'total'));
    }
}
