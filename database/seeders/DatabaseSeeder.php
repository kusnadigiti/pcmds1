<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'SUPER ADMIN',
            'email' => 'supadmin@example.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);

        User::factory()->create([
            'name' => 'Penulis 1',
            'email' => 'penulis@example.com',
            'password' => bcrypt('penulis123'),
            'role' => 'penulis',
        ]);

        User::factory()->create([
            'name' => 'Penulis 2',
            'email' => 'penulis2@example.com',
            'password' => bcrypt('penulis123'),
            'role' => 'penulis',
        ]);

        // $this->call([
        //     ArticleSeeder::class,
        // ]);
    }
}
