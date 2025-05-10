<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * This method populates the database with initial data, including
     * users, categories, and posts. It uses factories and manual inserts
     * to create the required records.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        $this->call([
            UserSeeder::class,
        ]);

        $this->call([
            CategorySeeder::class,
        ]);

        $this->call([
            PostSeeder::class,
        ]);
    }
}
