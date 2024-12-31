<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

        // Save order details to the database using Eloquent
        foreach ($cartItems as $item) {
            Order::create([
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $subtotal,
                'service_charge' => $serviceCharge,
                'total' => $total,
                'payment_method' => $paymentMethod,
            ]);
        }

        return view('bill', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'serviceCharge' => $serviceCharge,
            'total' => $total,
            'paymentMethod' => $paymentMethod
        ]);
    }
}
