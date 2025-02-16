<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
{
    $subtotal = $request->query('subtotal', 0);
    $shipping = $request->query('shipping', 0);
    $total = $request->query('total', 0);

    return view('payment', compact('subtotal', 'shipping', 'total'));
}

}
