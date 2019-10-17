<?php

use Illuminate\Database\Seeder;

class YearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Year\Year::create([
            "name" => "First Prep",
            "rank" => 1,
        ]);

        \App\Models\Year\Year::create([
            "name" => "Second Prep",
            "rank" => 2,
        ]);

        \App\Models\Year\Year::create([
            "name" => "Third Prep",
            "rank" => 3,
        ]);

        \App\Models\Year\Year::create([
            "name" => "First Secondary",
            "rank" => 4,
        ]);

        \App\Models\Year\Year::create([
            "name" => "Second Secondary",
            "rank" => 5,
        ]);

        \App\Models\Year\Year::create([
            "name" => "Third Secondary",
            "rank" => 6,
        ]);
    }
}
