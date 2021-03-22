<?php

namespace Database\Factories;

use App\Models\Plat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'nom' => $this->faker->sentence(2, true),
          'prix' => $this->faker->sentence(2, true),
          'type' => $this->faker->sentence(2, true),
          'vegetarien' => $this->faker->sentence(2, true),
          'poid' => $this->faker->sentence(2, true),
          'origine' => $this->faker->sentence(2, true),

        ];
    }
}
