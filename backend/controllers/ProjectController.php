<?php

namespace backend\controllers;

use backend\providers\MapDataProvider;
use core\entities\Project;
use core\entities\ProjectImage;
use core\read\FilterReadRepository;
use core\read\ProjectReadRepository;
use yii\helpers\Url;
use yii\rest\Controller;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    private $projects;
    private $filters;

    public function __construct($id, $module, ProjectReadRepository $projects, FilterReadRepository $filters, $config = [])
    {
        $this->projects = $projects;
        $this->filters = $filters;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $projects = $this->projects->getAll();
        return new MapDataProvider($projects, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $model = new Project();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function serializeListItem(Project $project): array
    {
        return [
            'id' => $project->id,
            'title' => $project->title,
            'square' => $project->square,
            'count' => $project->count_floors,
            'material' => $project->material->material,
            'text' => $project->description,
            'price' => $project->prise,
            'popular' => $project->popular,
            'filter' => $project->filter->filter,
            'images' => array_map(function (ProjectImage $image) {
                return $image->getThumbFileUrl('image', 'catalog_list');
            }, $project->images),
            '_links' => [
                'update' => ['href' => Url::to(['update', 'id' => $project->id], true)],
                'delete' => ['href' => Url::to(['delete', 'id' => $project->id], true)],
            ],
        ];
    }
}
