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
            "file" => "video_files/um_sonho_de_liberdade.mp4",
            "size" => "5000000",
            "created_at" => (new \DateTime())->format('Y-m-d H:i:s')
        ]);

        DB::table("movies")->insert([
            "name" => "O Poderoso Chefão",
            "file" => "video_files/poderoso_chefao_1.mp4",
            "size" => "4500000",
            "created_at" => (new \DateTime())->format('Y-m-d H:i:s')
        ]);

        DB::table("movies")->insert([
            "name" => "Batman: O Cavaleiro das Trevas",
            "file" => "video_files/batman_cavaleiro_das_trevas.mp4",
            "size" => "4800000",
            "created_at" => (new \DateTime())->format('Y-m-d H:i:s')
        ]);

        DB::table("movies")->insert([
            "name" => "Pulp Fiction: Tempo de Violência",
            "file" => "video_files/pulp_fiction.mp4",
            "size" => "4891385",
            "created_at" => (new \DateTime())->format('Y-m-d H:i:s')
        ]);
    }
}
