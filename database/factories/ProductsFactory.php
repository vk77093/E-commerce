<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pro_name'=>$this->faker->name(),
            'pro_price'=>$this->faker->numberBetween(1,200),
            'pro_description'=>$this->faker->paragraph(10),
            'pro_image'=>$this->faker->randomElement(['/uploads/book1.png','/uploads/book2.png','/uploads/book3.png']),
        ];
    }
}
