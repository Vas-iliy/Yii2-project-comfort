<?php

namespace core\readModels;

use core\entities\Client;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class ClientReadRepository
{
    public function getAll()
    {
        $query = Client::find();
        return $this->getProvider($query);
    }

    public function getAllNew()
    {
        $query = Client::find()->andWhere(['status' => Client::STATUS_NEW])->orderBy(['created_at' => SORT_DESC]);
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return Client::findOne($id);
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}