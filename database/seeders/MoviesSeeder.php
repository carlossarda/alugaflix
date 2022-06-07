<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("movies")->insert([
            "name" => "Um Sonho de Liberdade",
            "file" => "/storage/um_sonho_de_liberdade.mp4",
            "size" => "5000000"
        ]);

        DB::table("movies")->insert([
            "name" => "O Poderoso Chefão",
            "file" => "/storage/poderoso_chefao_1.mp4",
            "size" => "4500000"
        ]);

        DB::table("movies")->insert([
            "name" => "Batman: O Cavaleiro das Trevas",
            "file" => "/storage/batman_cavaleiro_das_trevas.mp4",
            "size" => "4800000"
        ]);

        DB::table("movies")->insert([
            "name" => "Pulp Fiction: Tempo de Violência",
            "file" => "/storage/pulp_fiction.mp4",
            "size" => "4891385"
        ]);
    }
}
