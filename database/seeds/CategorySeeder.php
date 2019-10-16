<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category\Category::create(["name" => "Category 1", "character_number" => 2]);

        \App\Models\Category\Category::create(["name" => "Category 2", "character_number" => 2]);

        \App\Models\Category\Category::create(["name" => "Category 3", "character_number" => 1]);
    }
}
