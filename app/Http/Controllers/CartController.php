<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function cartItems()
    {
        $cart = session('cart', []);
        return response()->json($cart);
    }


    public function addToCart(Request $request)
    {
        // Get the item details
        $menuItem = MenuItem::findOrFail($request->item_id);

        // Get the cart from the session or create a new one
        $cart = session()->get('cart', []);

        // Check if the item is already in the cart
        if (isset($cart[$menuItem->id])) {
            // Increment the quantity if the item already exists
            $cart[$menuItem->id]['quantity']++;
        } else {
            // Add a new item to the cart
            $cart[$menuItem->id] = [
                'name' => $menuItem->name,
                'price' => $menuItem->price,
                'quantity' => 1,
                'image' => $menuItem->image,
            ];
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        // Optionally redirect back to the menu or cart page with success message
        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    public function showCart()
    {
        $cart = session('cart', []); // Get cart from session
        $cartSubtotal = 0;

        // Calculate the cart subtotal by summing up the prices * quantities of items in the cart
        foreach ($cart as $id => $details) {
            $cartSubtotal += $details['price'] * $details['quantity'];
        }

        // Pass the subtotal and the cart to the view
        return view('cart', compact('cart', 'cartSubtotal'));
    }

    public function updateMultiple(Request $request)
    {
        if ($request->items) {
            $cart = session()->get('cart');

            // Loop through each item and update the cart session
            foreach ($request->items as $item) {
                if (isset($cart[$item['id']])) {
                    $cart[$item['id']]['quantity'] = $item['quantity'];
                }
            }

            // Update the session
            session()->put('cart', $cart);

            dd(session('cart'));

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }


    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}
