<?php

namespace Database\Factories;

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
    private static $product= 1;
    private static $brand= 1;
    public function definition()
    {
        return [
            'name' => "Product_" . self::$product++,
            'price' => rand(1000,1000000000),
            'brand' => "brand_" . self::$brand++,
        ];
    }
}
