<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Longaniza del Sur',
            'description' => 'Receta secreta de la abuelita Puca.',
            'price' => 9990,
            'stock' => 99,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Longaniza Ahumado en Roble',
            'description' => 'Ahumado artesanal lento con leña de roble del patio de Puca, sabor profundo.',
            'price' => 7490,
            'stock' => 99,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Longaniza Picante Pucástica',
            'description' => 'Con toque de merquén ahumado y amor de abuela.',
            'price' => 7490,
            'stock' => 99,
            'image' => null,
        ]);
    }
}
