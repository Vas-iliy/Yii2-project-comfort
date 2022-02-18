<?php

namespace core\readModels;

use core\entities\State;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class StateReadRepository
{
    public function getAll()
    {
        $query = State::find();
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return State::findOne($id);
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}