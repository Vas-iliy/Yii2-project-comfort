<?php

namespace backend\controllers;

use backend\lists\ProjectList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\Filter;
use core\entities\Material;
use core\entities\Project;
use core\entities\ProjectImage;
use core\forms\ProjectFrom;
use core\readModels\CacheReadRepository;
use core\readModels\FilterReadRepository;
use core\readModels\MaterialReadRepository;
use core\readModels\ProjectReadRepository;
use core\services\ProjectService;
use yii\helpers\Url;
use yii\rest\Controller;

class ServiceController extends Controller
{
    private $services;
    private $filters;
    private $materials;
    private $service;

    public function __construct($id, $module, ProjectReadRepository $services, FilterReadRepository $filters, MaterialReadRepository $materials, ProjectService $service, $config = [])
    {
        $this->projects = $services;
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
            'delete-image' => ['DELETE'],
        ];
    }

    public function actionIndex()
    {
        $services = $this->projects->getAll();
        return new MapDataProvider($services, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new ProjectFrom();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheProject());
        return [
            'errors' => $form->errors,
            'filters' => new MapDataProvider($this->filters->getAll(), [$this, 'formListFilter']),
            'materials' => new MapDataProvider($this->materials->getAll(), [$this, 'formListMaterial']),
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $service = $this->projects->find($id);
        $form = new ProjectFrom($service);
        AppController::actionUpdate($form, $this->service, $service->id, CacheReadRepository::cacheProject());
        return [
            'errors' => $form->errors,
            'project' => ProjectList::formProject($form),
            'images' => array_map(function (ProjectImage $image) {
                return [
                    'image' => $image->getThumbFileUrl('image', 'catalog_list'),
                    '_links' => ['href' => Url::to(['delete-image', 'id' => $image->id], true)]
                ];
            }, $service->images),
            'filters' => new MapDataProvider($this->filters->getAll(), [$this, 'formListFilter']),
            'materials' => new MapDataProvider($this->materials->getAll(), [$this, 'formListMaterial']),
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheProject());
        return [];
    }

    public function actionDeleteImage($id)
    {
        $image = $this->projects->getImage($id);
        $this->service->deleteImage($image);
        foreach (CacheReadRepository::cacheProject() as $value) {
            \Yii::$app->cache->delete($value);
        }
        return[];
    }

    public function serializeListItem(Project $service)
    {
        return ProjectList::serializeListItem($service);
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
