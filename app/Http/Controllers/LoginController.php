<?php

namespace App\Http\Controllers;

use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Models\Token;
use App\Models\User;
use App\Services\TokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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

        if (!$request->has(['email', 'password'])) {

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

        /** @var TokenService $tokenService */
        $tokenService = App::make(TokenService::class);
        $token = $tokenService->createToken($user);

        return response([
            'success' => true,
            'user' => new UserResource($user),
            'token' => new TokenResource($token)
        ],200);
    }

    public function logout(Request $request)
    {
        $user = $request->get('user');

        $tokens = Token::where('user_id', $user->id)
            ->where('expired', false)
            ->get();

        if (empty($tokens)) {
            return null;
        }

        foreach ($tokens as $token) {
            $token->expired = true;
            $token->save();
        }

        return response(null);
    }
}
