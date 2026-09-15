<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
        ]);

        User::forceCreate([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('1234'),
            'is_admin' => true,
        ]);
    }
}
