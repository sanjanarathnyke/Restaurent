<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuItem::firstOrCreate([
            'name' => 'Rainbow Roll',
            'description' => 'A sushi roll with colorful fish slices, usually tuna, salmon, and avocado.',
            'price' => 25.50,
            'image' => 'assets/images/menu/menu-1.jpg',
            'category_id' => 1 // Assuming 'Sushi' has an ID of 1
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Tuna Nigiri',
            'description' => 'A sushi roll with colorful fish slices, usually tuna, salmon, and avocado.',
            'price' => 25.50,
            'image' => 'assets/images/menu/menu-1.jpg',
            'category_id' => 1
        ]);

        MenuItem::firstOrCreate([
            'name' => 'California Roll',
            'description' => 'A sushi roll with colorful fish slices, usually tuna, salmon, and avocado.',
            'price' => 25.50,
            'image' => 'assets/images/menu/menu-1.jpg',
            'category_id' => 1
        ]);

         // Pizza items
         MenuItem::firstOrCreate([
            'name' => 'Pepperoni Pizza',
            'description' => 'Classic pepperoni pizza with mozzarella and tomato sauce.',
            'price' => 9.00,
            'image' => 'assets/images/menu/pizza-pepperoni.jpg',
            'category_id' => 2 // Pizza category
        ]);

        MenuItem::firstOrCreate([
            'name' => 'BBQ Pizza',
            'description' => 'Pizza with BBQ chicken, onions, and mozzarella cheese.',
            'price' => 17.00,
            'image' => 'assets/images/menu/pizza-bbq.jpg',
            'category_id' => 2
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Mushroom Pizza',
            'description' => 'Pizza topped with mushrooms, mozzarella, and tomato sauce.',
            'price' => 8.50,
            'image' => 'assets/images/menu/pizza-mushroom.jpg',
            'category_id' => 2
        ]);

        // Burger items
        MenuItem::firstOrCreate([
            'name' => 'Cheeseburger',
            'description' => 'Grilled beef patty with cheese, lettuce, and tomato.',
            'price' => 12.00,
            'image' => 'assets/images/menu/burger-cheeseburger.jpg',
            'category_id' => 3 // Burger category
        ]);

        MenuItem::firstOrCreate([
            'name' => 'BBQ Bacon Burger',
            'description' => 'Burger with BBQ sauce, bacon, and cheddar cheese.',
            'price' => 7.50,
            'image' => 'assets/images/menu/burger-bbq-bacon.jpg',
            'category_id' => 3
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Veggie Burger',
            'description' => 'Plant-based patty with lettuce, tomato, and avocado.',
            'price' => 11.50,
            'image' => 'assets/images/menu/burger-veggie.jpg',
            'category_id' => 3
        ]);

        // Steak items
        MenuItem::firstOrCreate([
            'name' => 'T-Bone Steak',
            'description' => 'Grilled T-Bone steak with garlic butter and herbs.',
            'price' => 30.00,
            'image' => 'assets/images/menu/steak-tbone.jpg',
            'category_id' => 4 // Steak category
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Ribeye Steak',
            'description' => 'Juicy ribeye steak cooked to perfection with rosemary.',
            'price' => 35.00,
            'image' => 'assets/images/menu/steak-ribeye.jpg',
            'category_id' => 4
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Sirloin Steak',
            'description' => 'Tender sirloin steak with a side of mashed potatoes.',
            'price' => 28.00,
            'image' => 'assets/images/menu/steak-sirloin.jpg',
            'category_id' => 4
        ]);

        // Chicken items
        MenuItem::firstOrCreate([
            'name' => 'Grilled Chicken',
            'description' => 'Grilled chicken breast served with steamed vegetables.',
            'price' => 20.00,
            'image' => 'assets/images/menu/chicken-grilled.jpg',
            'category_id' => 5 // Chicken category
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Fried Chicken',
            'description' => 'Crispy fried chicken served with fries and coleslaw.',
            'price' => 18.50,
            'image' => 'assets/images/menu/chicken-fried.jpg',
            'category_id' => 5
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Chicken Parmesan',
            'description' => 'Chicken breast topped with marinara sauce and mozzarella.',
            'price' => 22.00,
            'image' => 'assets/images/menu/chicken-parmesan.jpg',
            'category_id' => 5
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Chocolate Fudge Cake',
            'description' => 'Rich and moist chocolate cake with layers of fudge.',
            'price' => 8.50,
            'image' => 'assets/images/menu/cake-chocolate-fudge.jpg',
            'category_id' => 6 // Cake category
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Strawberry Cheesecake',
            'description' => 'A classic cheesecake with fresh strawberries on top.',
            'price' => 9.00,
            'image' => 'assets/images/menu/cake-strawberry-cheesecake.jpg',
            'category_id' => 6 // Cake category
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Red Velvet Cake',
            'description' => 'Soft and velvety red cake with a hint of cocoa and cream cheese frosting.',
            'price' => 10.00,
            'image' => 'assets/images/menu/cake-red-velvet.jpg',
            'category_id' => 6 // Cake category
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Lemon Drizzle Cake',
            'description' => 'A zesty lemon sponge cake with a sugar glaze.',
            'price' => 7.50,
            'image' => 'assets/images/menu/cake-lemon-drizzle.jpg',
            'category_id' => 6 // Cake category
        ]);

        // Beef Items
        MenuItem::firstOrCreate([
            'name' => 'Beefy Bourbon Bliss',
            'description' => 'Bourbon-infused beefy bliss, savory, smoky, sublime perfection.',
            'price' => 69.98,
            'image' => 'assets/images/menu/menu-4.jpg',
            'category_id' => 7 // Assuming 'Beef' has an ID of 7
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Spicy Beef Delight',
            'description' => 'Delicious beef cooked with a blend of spices and herbs.',
            'price' => 58.00,
            'image' => 'assets/images/menu/menu-5.jpg',
            'category_id' => 7 // Assuming 'Beef' has an ID of 7
        ]);

        // Grilled Items
        MenuItem::firstOrCreate([
            'name' => 'Grilled Chicken Deluxe',
            'description' => 'Succulent grilled chicken with herbs and spices.',
            'price' => 49.99,
            'image' => 'assets/images/menu/menu-6.jpg',
            'category_id' => 8 // Assuming 'Grilled' has an ID of 8
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Grilled Salmon',
            'description' => 'Fresh salmon fillet grilled to perfection with a citrus glaze.',
            'price' => 750.00,
            'image' => 'assets/images/menu/menu-7.jpg',
            'category_id' => 8
        ]);
        
        MenuItem::firstOrCreate([
            'name' => 'BBQ Grilled Ribs',
            'description' => 'Tender ribs coated in a smoky BBQ sauce, grilled for extra flavor.',
            'price' => 980.75,
            'image' => 'assets/images/menu/menu-8.jpg',
            'category_id' => 8
        ]);
        
        MenuItem::firstOrCreate([
            'name' => 'Grilled Vegetable Platter',
            'description' => 'A colorful assortment of seasonal vegetables, grilled to perfection.',
            'price' => 300.00,
            'image' => 'assets/images/menu/menu-9.jpg',
            'category_id' => 8
        ]);
        
        MenuItem::firstOrCreate([
            'name' => 'Spicy Grilled Shrimp',
            'description' => 'Marinated shrimp grilled with a spicy chili rub.',
            'price' => 750.50,
            'image' => 'assets/images/menu/menu-10.jpg',
            'category_id' => 8
        ]);

        // Sizzling Items
        MenuItem::firstOrCreate([
            'name' => 'Sizzling Prawn Delight',
            'description' => 'Sizzling prawns served with savory sauce.',
            'price' => 55.00,
            'image' => 'assets/images/menu/menu-7.jpg',
            'category_id' => 9 // Assuming 'Sizzling' has an ID of 9
        ]);

        MenuItem::firstOrCreate([
            'name' => 'Sizzling Chicken Fajitas',
            'description' => 'Grilled chicken served sizzling hot with bell peppers and onions.',
            'price' => 45.50,
            'image' => 'assets/images/menu/sizzling-chicken-fajitas.jpg',
            'category_id' => 9 // Assuming 'Sizzling' has an ID of 9
        ]);
        
        MenuItem::firstOrCreate([
            'name' => 'Sizzling Garlic Shrimp',
            'description' => 'Succulent shrimp sautéed with garlic, butter, and herbs on a sizzling plate.',
            'price' => 52.00,
            'image' => 'assets/images/menu/sizzling-garlic-shrimp.jpg',
            'category_id' => 9 // Assuming 'Sizzling' has an ID of 9
        ]);
        
        MenuItem::firstOrCreate([
            'name' => 'Sizzling Pork Chop',
            'description' => 'Juicy pork chop served sizzling with a side of mashed potatoes and grilled veggies.',
            'price' => 60.75,
            'image' => 'assets/images/menu/sizzling-pork-chop.jpg',
            'category_id' => 9 // Assuming 'Sizzling' has an ID of 9
        ]);
        
        MenuItem::firstOrCreate([
            'name' => 'Sizzling Veggie Delight',
            'description' => 'A sizzling mix of seasonal vegetables tossed in a light soy sauce.',
            'price' => 38.50,
            'image' => 'assets/images/menu/sizzling-veggie-delight.jpg',
            'category_id' => 9 // Assuming 'Sizzling' has an ID of 9
        ]);

        
    }
    }

