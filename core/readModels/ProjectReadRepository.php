<?php

namespace core\readModels;

use core\entities\Project;
use core\entities\ProjectImage;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

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

    public function getImage($id)
    {
        if (!$project = ProjectImage::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $project;
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}