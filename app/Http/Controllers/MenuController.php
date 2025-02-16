<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menu()
    {

        try {
            $categories = Category::all();
            return view('menu', compact('categories'));
        } catch (\Exception $e) {
            // Log the error or display a user-friendly message
            return back()->withErrors(['message' => 'Failed to load categories.']);
        }

    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'categoryName' => 'required|string|max:255',
            'menuItemName' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create or find category
        $category = Category::firstOrCreate(['name' => $request->input('categoryName')]);

        // Handle image upload
        $imagePath = $request->file('image')->store('menu_images', 'public');

        // Create menu item
        MenuItem::create([
            'name' => $request->input('menuItemName'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $imagePath,
            'category_id' => $category->id,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Menu item created successfully!');
    }
}
