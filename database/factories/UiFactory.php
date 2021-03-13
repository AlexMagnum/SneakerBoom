<?php

namespace Database\Factories;

use App\Models\Ui;
use Illuminate\Database\Eloquent\Factories\Factory;

class UiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ui::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'social1' => $this->faker->url,
            'social2' => $this->faker->url,
            'social3' => $this->faker->url,
            'social4' => $this->faker->url,
            'cta1_image' => $this->faker->url,
            'cta1_header' => $this->faker->paragraph,
            'cta1_desc' => $this->faker->paragraph,
            'cta1_url' => $this->faker->url,
            'cta2_image' => $this->faker->url,
            'cta2_header' => $this->faker->paragraph,
            'cta2_desc' => $this->faker->paragraph,
            'cta2_url' => $this->faker->url
        ];
    }
}
