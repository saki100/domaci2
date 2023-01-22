<?php

namespace Database\Seeders;

use App\Models\Tip;
use Illuminate\Database\Seeder;

class TipoviTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tip::create([
            'nazivTipa' => 'Traka za trcanje'
        ]);

        Tip::create([
            'nazivTipa' => 'Sobni bicikl'
        ]);
        
        Tip::create([
            'nazivTipa' => 'Trenazer'
        ]);

        Tip::create([
            'nazivTipa' => 'Vratilo'
        ]);

        Tip::create([
            'nazivTipa' => 'Gladijator'
        ]);
    }
}
