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
            "name" => "Drama",
            "created_at" => (new \DateTime())->format('Y-m-d H:i:s')
        ]);

        DB::table("tags")->insert([
            "name" => "Ação",
            "created_at" => (new \DateTime())->format('Y-m-d H:i:s')
        ]);

        DB::table("tags")->insert([
            "name" => "Policial",
            "created_at" => (new \DateTime())->format('Y-m-d H:i:s')
        ]);
    }
}
