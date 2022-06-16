<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $tokenReq = $request->header('Authorization');

        preg_match('/Bearer (.*)/', $tokenReq, $matches);

        $token = null;
        if (!empty($matches[1])) {
            $hoje = new \DateTime();
            $token = Token::where('token', $matches[1])
                ->where('expired', false)
                ->where('expires', '>', $hoje->format('Y-m-d H:i:s'))
                ->first();
        }

        if (empty($token)) {
            return response([], 401);
        }

        $request->attributes->add(['user' => $token->user]);

        return $next($request);
    }
}
