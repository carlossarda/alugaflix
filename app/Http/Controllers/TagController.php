<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create(Request $request)
    {
        $params = $request->all();

        if (!$request->has(['nome'])) {
            return response([
                "message" => "Wrong params"
            ], 400);
        }

        $tagExists = Tag::where('name', trim($params['nome']))->first();

        if (!empty($tagExists)) {
            return response([
                "message" => "Tag already exists"
            ], 400);
        }

        $tag = new Tag();
        $tag->name = trim($params['nome']);

        $tag->saveOrFail();

        return response(new TagResource($tag), 201);
    }

    public function update(Request $request, $id)
    {
        /** @var Tag $tag */
        $tag = Tag::find($id);

        if (empty($tag)) {
            return response([], 404);
        }

        $params = $request->all();

        if (!$request->has('nome')) {
            return response([
                "message" => "Wrong params"
            ], 400);
        }

        $tag->name = trim($params['nome']);
        $tag->saveOrFail();

        return response(new TagResource($tag));
    }
}
