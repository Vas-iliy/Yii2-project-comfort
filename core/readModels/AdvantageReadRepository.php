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

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}