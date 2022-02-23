<?php

namespace core\repositories\frontend;

use core\entities\Client;
use yii\web\NotFoundHttpException;

class ClientRepository
{
    public function get($id)
    {
        if (!$contact = Client::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $contact;
    }

    public function save(Client $client)
    {
        if (!$client->save()) throw new \RuntimeException('Saving error.');
    }

    public function isActive($phone)
    {
        return Client::find()->select('id')->andWhere(['phone' => $phone, 'status' => Client::STATUS_NEW])->limit(1)->one();
    }
}