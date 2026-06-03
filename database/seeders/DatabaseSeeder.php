<?php

namespace Database\Seeders;

use App\Models\Contact;
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

        // User::factory()->create([
        //     'name' => 'SUPER ADMIN',
        //     'email' => 'supadmin@example.com',
        //     'password' => bcrypt('password'),
        //     'role' => 'superadmin',
        // ]);

        // for ($i=0; $i < 5; $i++) { 
        //     User::factory()->create([
        //         'name' => 'Penulis '.$i,
        //         'email' => 'penulis'.$i.'@example.com',
        //         'password' => bcrypt('penulis123'),
        //         'role' => 'penulis',
        //     ]);
        // }



        // $this->call([
        //     ArticleSeeder::class,
        //     ContactSeeder::class,
        // ]);
    }
}
