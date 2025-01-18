<?php

namespace Database\Seeders;

use App\Models\Brindes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
