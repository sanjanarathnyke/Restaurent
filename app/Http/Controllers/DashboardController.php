<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getCategories()
    {
        return Category::all();
    }

    public function categoryitems()
    {
        $categoryCount = Category::count(); // Get the total count of categories
        return view('dashboard', compact('categoryCount'));
    }

    public function index(Request $request)
    {
        // Fetch menu items with their associated categories
        $menuItems = MenuItem::with('category')->paginate(6);

        // Get the total count of categories
        $categoryCount = Category::count();

        // Fetch the total count of menu items
        $totalMenuItems = MenuItem::count();

        return view('dashboard', compact('menuItems', 'categoryCount', 'totalMenuItems'));
    }


    // Function to handle saving the menu item
    public function saveMenuItem(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|unique:menu_items,name',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
        ]);

        // Check if the category exists or create it
        $category = Category::firstOrCreate(
            ['name' => $validatedData['category']],
            ['created_at' => now(), 'updated_at' => now()]
        );

        // Handle image upload if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        // Create and save the new menu item
        MenuItem::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $imagePath ?? '',
            'category_id' => $category->id,
        ]);

        // Return a success response
        return redirect()->back()->with('success', 'Category added successfully!');
    }

    //function to remove item form db   
    public function deleteItem($id)
    {
        $item = MenuItem::find($id);

        if ($item) {
            // Get the associated category ID
            $categoryId = $item->category_id;

            // Delete the menu item
            $item->delete();

            // Check if the category has no other menu items
            $remainingItems = MenuItem::where('category_id', $categoryId)->count();

            if ($remainingItems === 0) {
                // Delete the category if no items are linked to it
                Category::where('id', $categoryId)->delete();
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
}
