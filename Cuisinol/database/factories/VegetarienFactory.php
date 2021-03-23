<?php

namespace Database\Factories;

use App\Models\Vegetarien;
use Illuminate\Database\Eloquent\Factories\Factory;

class VegetarienFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vegetarien::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
     public function definition()
     {
         $name = $this->faker->word();
         return [
             'nom' => $name,
             'slug' => $name,
         ];
     }
}
