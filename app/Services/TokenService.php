<?php


namespace App\Services;


use App\Models\Token;
use App\Models\User;

class TokenService
{
    public function createToken(User $user)
    {
        $hoje = new \DateTime();
        $activeToken = Token::where('user_id', $user->id)
            ->where('expires', '>', $hoje->format('Y-m-d H:i:s'))
            ->where('expired', false)
            ->get();

        if (!empty($activeToken)) {
            /** @var Token $token */
            foreach ($activeToken as $token) {
                $token->expired = true;
                $token->save();
            }
        }

        $token = new Token();
        $token->token = md5(uniqid(rand(), true));
        $token->user_id = $user->id;
        $token->expired = false;

        $hoje->add(new \DateInterval('PT2H'));

        $token->expires = $hoje->format('Y-m-d H:i:s');


        $token->saveOrFail();

        return $token;
    }
}