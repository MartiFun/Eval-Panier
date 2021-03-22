<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      Plat::factory(10)->create();
    }
}
