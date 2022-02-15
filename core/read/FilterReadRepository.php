<?php

namespace core\read;

use core\entities\Filter;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class FilterReadRepository
{
    public function getAll()
    {
        $query = Filter::find()->with('projects');
        return $this->getProvider($query);
    }

    public function toProvider($project)
    {
        return $this->getProvider($project);
    }

    public function getWithProject($projectId)
    {

    }

    public function find($id)
    {
        return Filter::find()->andWhere(['id' => $id])->one();
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}