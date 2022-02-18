<?php

namespace core\readModels;

use core\entities\About;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class AboutReadRepository
{
    public function getAll()
    {
        $query = About::find();
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return About::findOne($id);
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}