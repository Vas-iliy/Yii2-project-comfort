<?php

namespace core\repositories\frontend;

use core\entities\Client;

class ClientRepository
{
    public function save(Client $client)
    {
        if (!$client->save()) throw new \RuntimeException('Saving error.');
    }

    public function isActive($phone)
    {
        return Client::find()->select('id')->where(['phone' => $phone])->where(['status' => Client::STATUS_NEW])->limit(1)->one();
    }
}