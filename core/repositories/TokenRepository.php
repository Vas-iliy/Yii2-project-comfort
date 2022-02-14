<?php


namespace core\repositories;


use core\entities\user\Token;
use core\repositories\frontend\Repository;

class TokenRepository extends Repository
{
    public function saveToken(Token $token)
    {
        return $this->save($token);
    }

    public function getToken(Token $token, $refreshToken)
    {
        return $this->getBy($token, ['refresh_token' => $refreshToken]);
    }
}