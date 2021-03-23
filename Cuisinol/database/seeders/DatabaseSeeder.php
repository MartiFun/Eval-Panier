<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ Plat, Type, Vegetarien, Ingredient, Ingredient_Plat };
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Dessert',
            'Entré',
            'Plat',
            'Gouter',
            'Sucré',
            'Salé',
        ];

        $vegetariens = [
            'Vegetarien',
            'normal',
            'sans gluten',
            'vegetalien',
        ];

        $plats = [
            'poulet braisé',
            'gatau chocolat',
            'pizza',
            'flan',
            'yaourt',
            'clafoutis aux abricots',
            'burger',
            'steak frites',
            'oreo',
            'sushi',
        ];

        $origines = [
          'Indien',
          'Français',
          'Chinois',
          'Japonais',
          'Africain',
        ];

        $ingredients = [
          'Oeuf',
          'Farine',
          'Sucre',
          'Ananas',
          'Tomate',
          'Fromage',
          'Fraise',
          'Beure',
        ];

        foreach($types as $type) {
            Type::create(['nom' => $type, 'slug' => Str::slug($type)]);
        }

        foreach($vegetariens as $vegetarien) {
            Vegetarien::create(['nom' => $vegetarien, 'slug' => Str::slug($vegetarien)]);
        }

        foreach($ingredients as $ingredient) {
            Ingredient::create(['nom' => $ingredient, 'slug' => Str::slug($ingredient)]);
        }

        foreach(range(1, 10) as $index)
    		{
    			Plat::create([
            'nom' => $plats[$index-1],
            'prix' => rand(1, 30),
            'type_id' => rand(1, 6),
            'vegetarien_id' => rand(1, 4),
            'poid' => rand(1, 500),
            'origine' => $origines[rand(0, 4)],
    			]);
    		}
    }
}
