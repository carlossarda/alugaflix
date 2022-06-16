<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function createUser(Request $request)
    {
        $params = $request->all();

        if (!$request->has(['nome', 'email', 'password', 'password_confirmation'])) {
            return response([
                "message" => 'Wrong params'
            ], 400);
        }

        if ($params['password'] !== $params['password_confirmation']) {
            return response([
                "message" => 'Password and confirmation doesn\'t match'
            ], 400);
        }

        $userExists = User::where('email', $params['email']);

        if (!empty($userExists)) {
            return response([
                "message" => 'User already exists'
            ], 400);
        }

        $user = new User();
        $user->name = $params['nome'];
        $user->email = $params['email'];
        $user->password = password_hash($params['password'], PASSWORD_BCRYPT);

        $user->saveOrFail();

        return response([], 201);
    }

    public function login(Request $request)
    {
        $params = $request->all();

        if (!$request->has(['email', 'passowrd'])) {
            return response([], 400);
        }

        $user = User::where('email', $params['email'])->first();

        if (empty($user)) {
            return response([
                "message" => "User not found"
            ], 403);
        }

        if (!password_verify($params['password'], $user->password)) {
            return response([
                "message" => "User or password invalid"
            ], 403);
        }

        return response([
            'success' => true,
            'user' => new UserResource($user),
            'token' => md5(uniqid(rand(), true))
        ],200);
    }
}
