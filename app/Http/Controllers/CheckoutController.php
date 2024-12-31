<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {

        $itemNames = explode(',', urldecode($request->get('items')));
        $subtotal = (float) $request->get('subtotal', 0);
        $total = (float) $request->get('total', 0);
        $shipping = (float) $request->get('shipping', 50);

        return view('checkout', compact('itemNames', 'subtotal', 'shipping', 'total'));
    }

    public function showBill(Request $request)
    {
        $cartItems = session('cart', []); // Retrieve cart items from session
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $serviceCharge = 50; // Fixed service charge
        $total = $subtotal + $serviceCharge;

        // Retrieve the selected payment method
        $paymentMethod = $request->input('payment_method', 'Not specified');


        return view('bill', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'serviceCharge' => $serviceCharge,
            'total' => $total,
            'paymentMethod' => $paymentMethod
        ]);
    }
}
