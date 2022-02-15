<?php

namespace backend\controllers;

use backend\lists\ProjectList;
use backend\providers\MapDataProvider;
use core\entities\Filter;
use core\entities\Material;
use core\entities\Project;
use core\forms\ProjectFrom;
use core\readModels\FilterReadRepository;
use core\readModels\MaterialReadRepository;
use core\readModels\ProjectReadRepository;
use core\services\ProjectService;
use Yii;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class ProjectController extends Controller
{
    private $projects;
    private $filters;
    private $materials;
    private $service;

    public function __construct($id, $module, ProjectReadRepository $projects, FilterReadRepository $filters, MaterialReadRepository $materials, ProjectService $service, $config = [])
    {
        $this->projects = $projects;
        $this->filters = $filters;
        $this->materials = $materials;
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function verbs(): array
    {
        return [
            'index' => ['GET'],
            'create' => ['GET', 'POST'],
            'update' => ['GET', 'PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    public function actionIndex()
    {
        $projects = $this->projects->getAll();
        return new MapDataProvider($projects, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new ProjectFrom();
        AppController::actionCreate($form, $this->service);
        return [
            'errors' => $form->errors,
            'filters' => new MapDataProvider($this->filters->getAll(), [$this, 'formListFilter']),
            'materials' => new MapDataProvider($this->materials->getAll(), [$this, 'formListMaterial']),
        ];
    }

    public function actionUpdate($id)
    {
        $project = $this->findModel($id);
        $form = new ProjectFrom($project);
        AppController::actionUpdate($form, $this->service, $project->id);
        return [
            'project' => ProjectList::formProject($form),
            'errors' => $form->errors,
            'filters' => new MapDataProvider($this->filters->getAll(), [$this, 'formListFilter']),
            'materials' => new MapDataProvider($this->materials->getAll(), [$this, 'formListMaterial']),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service);
        return [];
    }

    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }
        return [
            'error' => 'The requested page does not exist.'
        ];
    }

    public function serializeListItem(Project $project)
    {
        return ProjectList::serializeListItem($project);
    }

    public function formListFilter(Filter $filter)
    {
        return ProjectList::formListFilter($filter);

    }

    public function formListMaterial(Material $material)
    {
        return ProjectList::formListMaterial($material);
    }
}
