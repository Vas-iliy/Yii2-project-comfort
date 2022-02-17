<?php

namespace core\readModels;

use core\entities\Advantage;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class AdvantageReadRepository
{
    public function getAll()
    {
        $query = Advantage::find();
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return Advantage::findOne($id);
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}