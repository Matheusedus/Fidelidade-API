<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brindes;

class BrindeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brindes::create([
            'brinde' => 'Suco de Laranja',
            'valor' => 5,
        ]);

        Brindes::create([
            'brinde' => '10% de desconto',
            'valor' => 10,
        ]);

        Brindes::create([
            'brinde' => 'Almoço especial',
            'valor' => 20,
        ]);
    }
}
