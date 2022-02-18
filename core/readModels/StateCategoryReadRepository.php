<?php

namespace core\readModels;

use core\entities\StateCategory;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class StateCategoryReadRepository
{
    public function getAll()
    {
        $query = StateCategory::find();
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return StateCategory::findOne($id);
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}