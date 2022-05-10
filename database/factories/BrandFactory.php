<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nameArr = ["LG", "Samsung", "Sony", "Oppo", "Apple", "Xiaomi", "Panasonic"];
        return [
            'name' => $this->faker->unique()->randomElement($nameArr),
            'desc' => $this->faker->text(200),
            'status' => '1',
        ];
    }
}
