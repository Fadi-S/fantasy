<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin\Admin::create([
            'name' => "Administrator",
            'email' => "admin@alsharobim.com",
            'username' => "admin",
            'password' => "stgThanawyAdmin",
        ]);
    }
}
