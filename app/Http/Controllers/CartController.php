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

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $itemId = $request->id;
        $quantity = $request->quantity;

        // Fetch the current price from the database or another reliable source
        $item = MenuItem::find($itemId); // Replace Product with your model name

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found'], 404);
        }

        if ($quantity > 0) {
            // Update quantity and price in the session
            $cart[$itemId] = [
                'id' => $itemId,
                'name' => $item->name,
                'image' => $item->image, // Include other attributes if needed
                'price' => $item->price, // Update the price
                'quantity' => $quantity,
            ];
        } else {
            unset($cart[$itemId]); // Remove item if quantity is 0
        }

        session()->put('cart', $cart);

        // Calculate new totals
        $subtotal = array_reduce($cart, function ($carry, $cartItem) {
            return $carry + ($cartItem['price'] * $cartItem['quantity']);
        }, 0);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'subtotal' => $subtotal,
            'orderTotal' => $subtotal + 50, // Add shipping or other charges
        ]);
    }

    public function delete(Request $request)
    {
        dd($request->all());
        $cart = session()->get('cart', []);
        $itemId = $request->id;

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
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
                'id' => $menuItem->id,
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
