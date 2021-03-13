<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'destination_address' => $this->faker->address,
            'total_cost' => rand(0, 100000),
            'status' => 0,
            'note' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'paymentsystem' => "Оплата готівкою при отриманні"
        ];
    }
}
