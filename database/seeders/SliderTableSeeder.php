<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            // 'title' => "Акція 'Життя в стилі еко'",
            'image' => '',
            'description' => 'Короткий текст',
            'link' => '№',
            'type' => 1,
        ]);
        DB::table('sliders')->insert([
            // 'title' => "Акція 'Життя в стилі еко'",
            'image' => '',
            'description' => 'Короткий текст',
            'link' => '№',
            'type' => 1,
        ]);
    }
}
