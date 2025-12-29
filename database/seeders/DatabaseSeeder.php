<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductList;
use App\Models\ProductListItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        $categoryNames = [
            'Fruits & Vegetables',
            'Dairy Products',
            'Bakery Items',
            'Meat & Seafood',
            'Beverages',
            'Snacks',
            'Household Supplies',
            'Personal Care',
            'Frozen Foods',
            'Canned Goods',
        ];

        foreach ($categoryNames as $name) {
            Category::firstOrCreate(['name' => $name]);
        }

        Product::factory()->count(50)->create();
        ProductList::factory()->count(5)->create();
        ProductListItem::factory()->count(10)->create();
    }
}
