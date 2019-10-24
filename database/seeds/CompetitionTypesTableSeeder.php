<?php

use Illuminate\Database\Seeder;

class CompetitionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CompetitionType\CompetitionType::create(["name" => "User Points"]);

        \App\Models\CompetitionType\CompetitionType::create(["name" => "Average Character Points"]);
    }
}
