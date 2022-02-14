<?php

namespace core\services\auth;

use core\entities\user\Token;
use core\repositories\TokenRepository;

class TokenService
{
    private $tokens;

    public function __construct()
    {
        $this->tokens = new TokenRepository();
    }

    public function editSuccessToken($refresh)
    {
        $token = new Token();
        if ($tokens = $this->tokens->getToken($token, $refresh)) {
            $tokens->editAccessToken();
            return true;
        }
        return false;
    }
}