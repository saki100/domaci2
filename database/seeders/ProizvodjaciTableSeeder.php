<?php

namespace Database\Seeders;

use App\Models\Proizvodjac;
use Illuminate\Database\Seeder;

class ProizvodjaciTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proizvodjac::create([
            'nazivProizvodjaca' => 'Xplorer'
        ]);

        Proizvodjac::create([
            'nazivProizvodjaca' => 'Ring'
        ]);

        Proizvodjac::create([
            'nazivProizvodjaca' => 'Gym Fit'
        ]);

        Proizvodjac::create([
            'nazivProizvodjaca' => 'Sport Vision'
        ]);



    }
}
