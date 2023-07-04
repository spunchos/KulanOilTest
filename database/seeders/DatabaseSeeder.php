<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::factory(10)->create();
        User::factory(1)->create([
            'name'     => 'admin',
            'email'    => 'admin@test.com',
            'role'     => 'admin',
            'password' => bcrypt('admin'),
        ]);
        User::factory(1)->create([
            'name'     => 'testuser',
            'email'    => 'test@test.com',
            'role'     => 'manager',
            'password' => bcrypt('test'),
        ]);
//        City::factory(10)->create();
        Application::factory(10)->create();
    }
}
