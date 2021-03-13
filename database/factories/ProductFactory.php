<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'manufacturer' => $this->faker->randomElement([
                'Nike',
                'Adidas',
                'New Balance',
                'Puma',
                'Reebok',
                'Asics',
                'Vans',
                'Converse',
                'Saucony',
                'Fila',
                'Diadora',
                'Dr. Martens',
                'Timberland',
                'UGG'
            ]),
            'model' => Str::random(5),
            'code' => $this->faker->postcode,
            'price' => rand(0, 10000),
            'price_without_discount' => rand(0, 10000),
            'count' => rand(0,100),
            'rating' => rand(1,5),
            'poster' => Str::random(10),
            'images' => Str::random(25),
            'slider' => 0,
            'slider_slog' => Str::random(25),
            'sale_count' => rand(0,1000),
            'discount' => rand(0,100),
            'highlights' => $this->faker->paragraph,
            'description' => $this->faker->paragraph,
            'color' => Str::random(4)
        ];
    }
}
