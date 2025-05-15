<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('families')->insert([
            [
                'name' => 'Bebidas',
                'description' => 'Productos líquidos como agua, refrescos y jugos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Snacks',
                'description' => 'Aperitivos como papas fritas, galletas y frutos secos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lácteos',
                'description' => 'Productos derivados de la leche como quesos y yogures.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carnes',
                'description' => 'Productos cárnicos como pollo, res y cerdo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Frutas y Verduras',
                'description' => 'Productos frescos como manzanas, plátanos y zanahorias.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
