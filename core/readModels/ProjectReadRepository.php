<?php

namespace core\readModels;

use core\entities\Project;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class ProjectReadRepository
{
    public function getAll()
    {
        $query = Project::find()->with('filter', 'images', 'material');
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return Project::find()->andWhere(['id' => $id])->one();
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}