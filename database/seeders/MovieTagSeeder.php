<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\MovieTag;
use App\Models\Tag;
use Exception;
use Illuminate\Database\Seeder;

class MovieTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();

        $movies = Movie::all();

        foreach ($movies as $movie) {
            $movieTag = null;
            $movieTag = new MovieTag();
            $movieTag->movie_id = $movie->id;

            $randomInt = random_int(0, count($tags) - 1);

            $movieTag->tag_id = $tags[$randomInt]->id;

            try {
                $movieTag->save();
            } catch (Exception $exception) {
                continue;
            }
        }
    }
}
