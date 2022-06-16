<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\TagController;
use App\Http\Resources\MovieResource;
use App\Http\Resources\TagResource;
use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(MovieController::class)->group(function () {
    Route::get('/movies', function () {
        return MovieResource::collection(Movie::all());
    });

    Route::get('/movies/{id}', function ($id) {
        return new MovieResource(Movie::find($id));
    });
});

Route::controller(TagController::class)->group(function () {
    Route::get('/tags', function () {
        return TagResource::collection(Tag::all());
    });

    Route::get('/tags/{id}', function ($id) {
        return new TagResource(Tag::find($id));
    });
});