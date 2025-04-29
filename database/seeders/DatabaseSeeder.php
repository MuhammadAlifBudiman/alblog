<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
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
            'name' => 'mamang',
            'username' => 'mamang',
            'email' => 'mamang@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        User::factory(10)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();
    }
}
