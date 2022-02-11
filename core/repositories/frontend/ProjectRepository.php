<?php

namespace core\repositories\frontend;

use core\entities\Filter;
use core\entities\Project;

class ProjectRepository
{
    public function getProjectPopular()
    {
        $projects = \Yii::$app->cache->get('projects_popular');
        if (empty($projects)) {
            $projects = Project::find()->andWhere(['popular' => 1])->with('images')->limit(6)->all();
            \Yii::$app->cache->set('projects_popular', $projects, 3600*24*30);
        }
        return $projects;
    }

    public function getProjects($filter = null)
    {
        if (!empty($filter)) {
            if (is_array($filter)) {
                $str = trim(implode(',', $filter));
                $projects = \Yii::$app->cache->get("projects_" . $str);
                if (empty($projects)) {
                    $filters = [];
                    foreach ($filter as $value) {
                        $filters[] = Filter::findOne($value);
                    }
                    $projects = $this->projectFilters($filters);
                    \Yii::$app->cache->set("projects_" . $str, $projects, 3600*24*30);
                }
                return $projects;
            }
            $projects = \Yii::$app->cache->get("projects_" . $filter);
            if (empty($projects)) {
                $fil = Filter::findOne($filter);
                $projects = $fil->getProjects()->with('images')->all();
                \Yii::$app->cache->set("projects_" . $filter, $projects, 3600*24*30);
            }
            return $projects;
        }
        $projects = \Yii::$app->cache->get('projects');
        if (empty($projects)) {
            $projects = Project::find()->with('images')->all();
            \Yii::$app->cache->set('projects', $projects, 3600*24*30);
        }
        return $projects;
    }

    private function projectFilters($filters)
    {
        $project = [];
        foreach ($filters as $filter) {
            if (!empty($project) && !empty($filter->projects)) {
                foreach ($project as $k => $value) {
                    foreach ($filter->projects as $item) {
                        if($value->id == $item->id) {
                            unset($project[$k]);
                        }
                    }
                }
                $project = array_merge($project, $filter->projects);
            } elseif (!empty($filter->projects)) {
                $project = $filter->getProjects()->with('images')->all();
            }
        }
        return $project;
    }

}