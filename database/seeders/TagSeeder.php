<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tags")->insert([
            "name" => "Drama"
        ]);

        DB::table("tags")->insert([
            "name" => "Ação"
        ]);

        DB::table("tags")->insert([
            "name" => "Policial"
        ]);
    }
}