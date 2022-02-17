<?php

namespace core\readModels;

use core\entities\Material;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class MaterialReadRepository
{
    public function getAll()
    {
        $query = Material::find();
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return Material::find()->andWhere(['id' => $id])->one();
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}