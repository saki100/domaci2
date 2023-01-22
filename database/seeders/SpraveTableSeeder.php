<?php

namespace Database\Seeders;

use App\Models\Sprava;
use Illuminate\Database\Seeder;

class SpraveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 40; $i++) {

            Sprava::create([
                'tipID' => $faker->numberBetween(1,5),
                'model' => strtoupper($faker->bothify('? #')),
                'proizvodjacID' => $faker->numberBetween(1,4),
                'cena' => $faker->numberBetween(1000,4000) . ' EUR',
            ]);
        }
    }
}
