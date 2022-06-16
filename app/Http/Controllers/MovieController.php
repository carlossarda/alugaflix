<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Models\MovieTag;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    public function create(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'arquivo' => 'mimetypes:video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv|max:5120000'
        ]);

        if ($validator->fails()) {
            return response([
                "message" => 'File is not a video or exceed max size'
            ], 400);
        }

        if (!$request->has(['nome', 'arquivo', 'tamanho_arquivo'])) {
            return response([
                "message" => 'Wrong params'
            ], 400);
        }

        $movie = new Movie();
        $movie->name = trim($params['nome']);
        $movie->size = $params['tamanho_arquivo'];

        /** @var UploadedFile $file */
        $file = $params['arquivo'];
        $movie->file = $file->store('video_files');

        $movie->saveOrFail();

        return response(new MovieResource($movie), 201);
    }

    public function update(Request $request, $id)
    {
        /** @var Movie $movie */
        $movie = Movie::find($id);

        if (empty($movie)) {
            return response([], 404);
        }

        $params = $request->all();

        if (!empty($params['nome'])) {
            $movie->name = trim($params['nome']);
        }

//        if (!empty($params['size'])) {
//            $movie->size = $params['size'];
//        }
//
//        if (!empty($params['arquivo'])) {
//            /** @var UploadedFile $file */
//            $file = $params['arquivo'];
//            $movie->file = $file->store('video_files');
//        }

        if (!empty($params['tags']) && is_array($params['tags'])) {
            foreach ($params['tags'] as $tagReq) {
                if (empty($tagReq['id'])) {
                    continue;
                }

                $movieTag = MovieTag::where('movie_id', $id)
                    ->where('tag_id', $tagReq['id'])
                    ->first();

                if (!empty($movieTag)) {
                    continue;
                }

                $movieTag = MovieTag::withTrashed()->where('movie_id', $id)
                    ->where('tag_id', $tagReq['id'])
                    ->first();


                if (!empty($movieTag)) {
                    $movieTag->restore();
                    continue;
                }

                $movieTag = new MovieTag();
                $movieTag->movie_id = $id;
                $movieTag->tag_id = $tagReq['id'];

                $movieTag->save();
            }
        }

        $movie->saveOrFail();

        return response(new MovieResource($movie));
    }

    public function delete($id)
    {
        /** @var Movie $movie */
        $movie = Movie::find($id);

        if (empty($movie)) {
            return response([], 404);
        }

        $movie->delete();

        $tags = MovieTag::where('movie_id', $movie->id)->get();

        if (!empty($tags)) {
            /** @var MovieTag $movieTag */
            foreach ($tags as $movieTag) {
                $movieTag->delete();
            }
        }

        return response();
    }

    public function getMovies(Request $request)
    {
        $params = $request->all();
        $order = 'asc';

        if (!empty($params['order'])) {
            $order = $params['order'];
        }

        $movies = Movie::withoutTrashed()
            ->orderBy('name', $order)
            ->get();

        return response(MovieResource::collection($movies));
    }
}
