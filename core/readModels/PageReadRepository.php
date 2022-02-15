<?php

namespace core\readModels;

use core\entities\Page;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class PageReadRepository
{
    public function getAll()
    {
        $query = Page::find();
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return Page::find()->andWhere(['id' => $id])->one();
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}