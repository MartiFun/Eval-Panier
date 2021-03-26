<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ Plat, Type, Vegetarien, Ingredient, Ingredient_Plat , User};
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
            ];

            $vegetariens = [
                'Vegetarien',
                'normal',
                'sans gluten',
                'vegetalien',
            ];

            $origines = [
              'Alderaan',
              'Polis Massa',
              'Corellia',
              'nowhere',
              'Kashyyyk',
              'Tatooine',
            ];

            $ingredients = [
              'fromage',
              'viande',
              'tomate',
              'salade',
              'bacon',
              'concombre',
              'galette de pomme de terre',
            ];

            $burgers = [
              [
                "nom" => "Leia Burger",
                "ingredients" => [1, 3, 4, 6, 7],
                "origines" => 0,
                "vegetariens" => 1,
                "types" => 3,
                "prix" => 9.50,
                "poid" => 150,
              ],
              [
                "nom"=> "Luke Burger",
                "ingredients"=> [2, 4],
                "origines"=> 1,
                "vegetariens" => 3,
                "types" => 3,
                "prix" => 10.50,
                "poid" => 175,
              ],
              [
                "nom"=> "Han Solo Burger",
                "ingredients"=> [5, 1, 2],
                "origines"=> 2,
                "vegetariens" => 2,
                "types" => 3,
                "prix" => 11.50,
                "poid" => 175,
              ],
              [
                "nom"=> "Double Han Solo",
                "ingredients"=> [5, 1, 2, 1, 2],
                "origines"=> 2,
                "vegetariens" => 2,
                "types" => 3,
                "prix" => 12.50,
                "poid" => 250,
              ],
              [
                "nom"=> "All-green Yoda Burger",
                "ingredients"=> [3, 4, 6, 7],
                "origines"=> 3,
                "vegetariens" => 4,
                "types" => 3,
                "prix" => 8,
                "poid" => 120,
              ],
              [
                "nom"=> "The Chewbacca",
                "ingredients"=> [6, 1, 2, 2, 2],
                "origines"=> 4,
                "vegetariens" => 2,
                "types" => 3,
                "prix" => 11,
                "poid" => 200,
              ],
              [
                "nom"=> "Dark Vador Burger",
                "ingredients"=> [6, 5, 2, 4],
                "origines"=> 5,
                "vegetariens" => 2,
                "types" => 3,
                "prix" => 12.50,
                "poid" => 250,
              ],
            ];

            foreach($types as $type) {
                Type::create(['nom' => $type, 'slug' => Str::slug($type)]);
            }

            User::factory()->create();


            foreach($vegetariens as $vegetarien) {
                Vegetarien::create(['nom' => $vegetarien, 'slug' => Str::slug($vegetarien)]);
            }

            foreach($ingredients as $ingredient) {
                Ingredient::create(['nom' => $ingredient, 'slug' => Str::slug($ingredient)]);
            }


            foreach ($burgers as $burger) {
              $plat = Plat::create([
                'nom' => $burger['nom'],
                'prix' => $burger['prix'],
                'type_id' => $burger['types'],
                'vegetarien_id' => $burger['vegetariens'],
                'poid' => $burger['poid'],
                'origine' => $origines[$burger['origines']],
              ]);
              foreach ($burger['ingredients'] as $ingredient) {
                $plat->ingredients()->attach($ingredient);
              }
            }

        }
}
