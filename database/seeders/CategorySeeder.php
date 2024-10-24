<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Sushi',
            'Pizza',
            'Burger',
            'Steak',
            'Chicken',
            'Cake',
            'Beef',     // Add Beef Category
            'Grilled',  // Add Grilled Category
            'Sizzling', // Add Sizzling Category
        ];

        foreach ($categories as $category) {
            // Check if the category already exists before creating it
            Category::firstOrCreate(['name' => $category]);
        }

    }
}
