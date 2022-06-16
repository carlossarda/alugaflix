<?php

use App\Http\Controllers\LoginController;
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

Route::controller(MovieController::class)->prefix('movies')->group(function () {
    Route::get('', function () {
        return MovieResource::collection(Movie::all());
    });

    Route::get('/{id}', function ($id) {
        return new MovieResource(Movie::find($id));
    });

    Route::post('/create', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::controller(TagController::class)->prefix('tags')->group(function () {
    Route::get('', function () {
        return TagResource::collection(Tag::all());
    });

    Route::get('/{id}', function ($id) {
        return new TagResource(Tag::find($id));
    });

    Route::post("/create", 'create');
    Route::put('/update', 'update');
});

Route::controller(LoginController::class)->prefix('login')->group(function () {
    Route::get('', 'login');
    Route::post('/create', 'createUser');
});