<?php

namespace core\repositories;

use core\entities\user\Token;
use yii\web\NotFoundHttpException;

class TokenRepository
{
    public function save(Token $token)
    {
        if (!$return = $token->save()) throw new \RuntimeException('Saving error.');
        return $return;
    }

    public function get($refreshToken)
    {
        if (!$return = Token::find()->andWhere(['refresh_token' => $refreshToken])->limit(1)->one()) {
            throw new NotFoundHttpException('Not found');
        }
        return $return;
    }
}