<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // параметр random ни на что не влияет, нужен только для того, чтобы картинка каждый раз была разной
             'image_url' => 'https://cataas.com/cat?random=' . $this->faker->numberBetween(1, 1000),
        ];
    }
}
