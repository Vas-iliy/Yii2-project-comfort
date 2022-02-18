<?php

namespace core\readModels;

use core\entities\ServicePoint;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class ServicePointReadRepository
{
    public function getAll()
    {
        $query = ServicePoint::find();
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return ServicePoint::findOne($id);
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}