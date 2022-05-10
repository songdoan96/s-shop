<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nameArr = ['Tivi', 'Tủ lạnh', 'Máy tính', 'Điện thoại', 'Điều hòa', 'Máy giặt', 'Phụ kiện ', 'Đồng hồ'];

        // $nameArr = ["Máy giặt", "Máy tính", "Tivi", "Tủ lạnh", "Điện thoại", "Điều hòa"];
        return [
            'name' => $this->faker->unique()->randomElement($nameArr),
            'desc' => $this->faker->text(200),
            'status' => '1',
        ];
    }
}
