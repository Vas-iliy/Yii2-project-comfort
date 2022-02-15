<?php

namespace core\repositories;

use core\entities\Filter;
use core\entities\Project;
use yii\data\Pagination;

class ProjectRepository extends Repository
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
                    $projects = $this->getProjectFromFilters($filter);
                    \Yii::$app->cache->set("projects_" . $str, $projects, 3600*24*30);
                }
                return $projects;
            }
            $projects = \Yii::$app->cache->get("projects_" . $filter);
            if (empty($projects)) {
                $fil = Filter::findOne($filter);
                $projects = $fil->getProjects()->with('images')->with('material');
                \Yii::$app->cache->set("projects_" . $filter, $projects, 3600*24*30);
            }
            return $projects;
        }
        $projects = \Yii::$app->cache->get('projects');
        if (empty($projects)) {
            $projects = Project::find()->with('images')->with('material');
            \Yii::$app->cache->set('projects', $projects, 3600*24*30);
        }
        return $projects;
    }

    public function saveProject($project)
    {
        return $this->save($project);
    }

    public function pagination($projects)
    {
        $pages = new Pagination(['totalCount' => $projects->count(), 'pageSize' => \Yii::$app->params['projectCount'], 'forcePageParam' => false, 'pageSizeParam' => false]);
        return [
            'pages' => $pages,
            'projects' => $projects->offset($pages->offset)->limit($pages->limit)->all()
        ];
    }

    private function getProjectFromFilters($filters)
    {
        return Project::find()->andWhere(['in','filter_id', $filters])->with('images')->with('material');
    }
}