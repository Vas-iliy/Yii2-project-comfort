<?php

namespace backend\controllers;

use backend\providers\MapDataProvider;
use core\entities\Filter;
use core\entities\Material;
use core\entities\Project;
use core\entities\ProjectImage;
use core\forms\ProjectFrom;
use core\read\FilterReadRepository;
use core\read\MaterialReadRepository;
use core\read\ProjectReadRepository;
use core\services\ProjectService;
use Yii;
use yii\helpers\Url;
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

    public function actionIndex()
    {
        $projects = $this->projects->getAll();
        return new MapDataProvider($projects, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new ProjectFrom();
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()) {
            try {
                $this->service->create($form);
                Yii::$app->getResponse()->setStatusCode(201);
                return [];
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        return [
            'errors' => $form->errors,
            'filters' => new MapDataProvider($this->filters->getAll(), [$this, 'formListFilter']),
            'materials' => new MapDataProvider($this->materials->getAll(), [$this, 'formListMaterial']),
        ];
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

    public function formListFilter(Filter $filter)
    {
        return [
            'id' => $filter->id,
            'title' => $filter->filter
        ];
    }

    public function formListMaterial(Material $material)
    {
        return [
            'id' => $material->id,
            'title' => $material->material
        ];
    }
}
