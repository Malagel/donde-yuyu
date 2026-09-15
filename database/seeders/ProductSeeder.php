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
            'description' => 'Ahumado artesanal lento con leña de roble, sabor profundo.',
            'price' => 7490,
            'stock' => 99,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Longaniza Picante al Merquén',
            'description' => 'Con toque de merquén ahumado y ají cacho de cabra.',
            'price' => 7490,
            'stock' => 99,
            'image' => null,
        ]);
    }
}
