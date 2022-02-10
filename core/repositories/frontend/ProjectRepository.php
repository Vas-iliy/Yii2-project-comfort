<?php

namespace core\repositories\frontend;

use core\entities\Project;
use yii\web\NotFoundHttpException;

class ProjectRepository
{
    public function getProjectPopular()
    {
        $projects = \Yii::$app->cache->get('projects_popular');
        if (empty($projects)) {
            $projects = Project::find()->andWhere(['popular' => 1])->limit(6)->all();
            \Yii::$app->cache->set('projects_popular', $projects, 3600*24*30);
        }
        return $projects;
    }

}