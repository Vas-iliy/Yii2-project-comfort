<?php

namespace core\repositories\frontend;

use core\entities\Project;
use yii\web\NotFoundHttpException;

class ProjectRepository
{
    public function getProjectPopular()
    {
        if (!$projects = Project::find()->andWhere(['popular' => 1])->limit(6)->all()) {
            throw new NotFoundHttpException('No contacts.');
        }
        return $projects;
    }

}