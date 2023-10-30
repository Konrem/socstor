<?php

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
        $this->call([
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            ConfigsTableSeeder::class,
            BlocksTableSeeder::class,
            NewsTableSeeder::class,
            PagesTableSeeder::class,
            SliderTableSeeder::class,
        ]);
    }
}
