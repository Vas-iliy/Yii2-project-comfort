<?php

namespace common\auth;

use core\entities\user\User;
use core\readModels\UserReadRepository;
use Yii;
use yii\web\IdentityInterface;

class Identity implements IdentityInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function findIdentity($id)
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user): null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return User::find()
            ->joinWith(['user_tokens t'])
            ->andWhere(['t.access_token' => $token])
            ->andWhere(['>', 't.expire', time()])
            ->one();
    }

    public function getId()
    {
        return $this->user->id;
    }

    public function getAuthKey()
    {
        return $this->user->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function checkUserCredentials($username, $password)
    {
        if (!$user = self::getRepository()->findActiveByUsername($username)) {
            return false;
        }
        return $user->validatePassword($password);
    }

    public function getUserDetails($username)
    {
        $user = self::getRepository()->findActiveByUsername($username);
        return ['user_id' => $user->id];
    }

    private static function getRepository()
    {
        return \Yii::$container->get(UserReadRepository::class);
    }

    private static function getOauth()
    {
        return Yii::$app->getModule('oauth2');
    }
}