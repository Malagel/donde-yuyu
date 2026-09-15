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
            'name' => 'Longaniza de San Carlos',
            'description' => 'Receta secreta de la abuelita Yuyu.',
            'price' => 9990,
            'stock' => 99,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Longaniza Ahumado en Roble',
            'description' => 'Ahumado artesanal lento con leña de roble del patio de Yuyú, sabor profundo.',
            'price' => 7490,
            'stock' => 99,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Longaniza Picante Yuyástica',
            'description' => 'Con toque de merquén ahumado y amor de abuela.',
            'price' => 7490,
            'stock' => 99,
            'image' => null,
        ]);
    }
}
