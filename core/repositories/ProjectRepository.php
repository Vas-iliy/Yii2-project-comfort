<?php

namespace core\repositories;

use core\entities\Filter;
use core\entities\Project;
use core\entities\ProjectImage;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ProjectRepository
{
    public function getProjectPopular()
    {
        $projects = \Yii::$app->cache->get('projects_popular');
        if (empty($projects)) {
            $projects = Project::find()->andWhere(['popular' => 1, 'status' => Project::STATUS_ACTIVE])->with('images')->limit(6)->all();
            \Yii::$app->cache->set('projects_popular', $projects, 3600*24*30);
        }
        return $projects;
    }

    public function getProjects($filter = null)
    {
        if (!empty($filter)) {
            if (is_array($filter)) {
                sort($filter, SORT_NUMERIC);
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
                $projects = $fil->getProjects()->andWhere(['status' => Project::STATUS_ACTIVE])->with('images', 'material');
                \Yii::$app->cache->set("projects_" . $filter, $projects, 3600*24*30);
            }
            return $projects;
        }
        $projects = \Yii::$app->cache->get('projects');
        if (empty($projects)) {
            $projects = Project::find()->andWhere(['status' => Project::STATUS_ACTIVE])->with('images', 'material');
            \Yii::$app->cache->set('projects', $projects, 3600*24*30);
        }
        return $projects;
    }

    public function save($project)
    {
        if (!$return = $project->save()) throw new \RuntimeException('Saving error.');
        return $return;
    }

    public function remove(Project $project)
    {
        $project->status = $project::STATUS_DELETED;
        if (!$project->save()) throw new \RuntimeException('Removing error.');
    }

    public function get($id)
    {
        if (!$project = Project::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $project;
    }

    public function getId($image_id)
    {
        if (!$project = ProjectImage::find()->select('project_id')->where(['id' => $image_id])->limit(1)->one()->project_id) throw new NotFoundHttpException('Not found.');
        return $project;
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
        return Project::find()->andWhere(['status' => Project::STATUS_ACTIVE])->andWhere(['in','filter_id', $filters])->with('images')->with('material');
    }
}