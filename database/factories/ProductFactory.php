<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Fruits & Vegetables' => [
                'Apple', 'Banana', 'Carrot', 'Lettuce', 'Tomato', 'Potato', 'Onion', 'Orange', 'Cucumber', 'Spinach',
            ],
            'Dairy Products' => [
                'Milk', 'Cheese', 'Yogurt', 'Butter', 'Cream', 'Cottage Cheese', 'Sour Cream', 'Ice Cream',
            ],
            'Bakery Items' => [
                'Bread', 'Bagel', 'Croissant', 'Muffin', 'Baguette', 'Donut', 'Roll', 'Pita',
            ],
            'Meat & Seafood' => [
                'Chicken Breast', 'Beef Steak', 'Pork Chop', 'Salmon Fillet', 'Shrimp', 'Turkey', 'Bacon', 'Sausage',
            ],
            'Beverages' => [
                'Orange Juice', 'Apple Juice', 'Cola', 'Coffee', 'Tea', 'Mineral Water', 'Lemonade', 'Milkshake',
            ],
            'Snacks' => [
                'Potato Chips', 'Chocolate Bar', 'Granola Bar', 'Popcorn', 'Pretzels', 'Cookies', 'Crackers',
            ],
            'Household Supplies' => [
                'Paper Towels', 'Toilet Paper', 'Dish Soap', 'Laundry Detergent', 'Sponges', 'Trash Bags',
            ],
            'Personal Care' => [
                'Shampoo', 'Toothpaste', 'Soap', 'Deodorant', 'Toothbrush', 'Lotion', 'Razor',
            ],
            'Frozen Foods' => [
                'Frozen Pizza', 'Frozen Vegetables', 'Ice Cream', 'Frozen Berries', 'Frozen Fries',
            ],
            'Canned Goods' => [
                'Canned Beans', 'Canned Corn', 'Canned Tuna', 'Canned Tomatoes', 'Canned Soup',
            ],
        ];

        $category = $this->faker->randomElement(array_keys($categories));
        $productName = $this->faker->randomElement($categories[$category]);
        $categoryId = Category::where('name', $category)->value('id');

        return [
            'name' => $productName,
            'category_id' => $categoryId,
            'default_unit' => $this->faker->randomElement(['piece', 'kg', 'litre', 'pack']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
