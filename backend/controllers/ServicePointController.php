<?php

namespace backend\controllers;

use backend\lists\ServicePointList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\ServicePoint;
use core\forms\ServicePointFrom;
use core\readModels\CacheReadRepository;
use core\readModels\ServicePointReadRepository;
use core\services\ServicePointService;
use yii\rest\Controller;

class ServicePointController extends Controller
{
    private $points;
    private $service;

    public function __construct($id, $module, ServicePointReadRepository $points, ServicePointService $service, $config = [])
    {
        $this->points = $points;
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
        $points = $this->points->getAll();
        return new MapDataProvider($points, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new ServicePointFrom();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheService());
        return [
            'errors' => $form->errors,
        ];
    }

    public function actionUpdate($id)
    {
        $point = $this->points->find($id);
        $form = new ServicePointFrom($point);
        AppController::actionUpdate($form, $this->service, $point->id, CacheReadRepository::cacheService());
        return [
            'errors' => $form->errors,
            'point' => ServicePointList::formService($form),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheService());
        return [];
    }

    public function serializeListItem(ServicePoint $point)
    {
        return ServicePointList::serializeListItem($point);
    }
}
