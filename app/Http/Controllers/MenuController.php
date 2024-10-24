<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
}
