<?php

namespace backend\controllers;

use backend\lists\ServiceList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\Service;
use core\entities\ServiceImage;
use core\forms\ServiceFrom;
use core\readModels\CacheReadRepository;
use core\readModels\ServiceReadRepository;
use core\services\ServiceService;
use yii\helpers\Url;
use yii\rest\Controller;

class ServiceController extends Controller
{
    private $services;
    private $service;

    public function __construct($id, $module, ServiceReadRepository $services, ServiceService $service, $config = [])
    {
        $this->services = $services;
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
        $services = $this->services->getAll();
        return new MapDataProvider($services, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new ServiceFrom();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheService());
        return [
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $service = $this->services->find($id);
        $form = new ServiceFrom($service);
        AppController::actionUpdate($form, $this->service, $service->id, CacheReadRepository::cacheService());
        return [
            'errors' => $form->errors,
            'service' => ServiceList::formService($form),
            'images' => array_map(function (ServiceImage $image) {
                return [
                    'image' => $image->getThumbFileUrl('image', 'catalog_list'),
                    '_links' => ['href' => Url::to(['delete-image', 'id' => $image->id], true)]
                ];
            }, $service->images),
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheService());
        return [];
    }

    public function actionDeleteImage($id)
    {
        $image = $this->services->getImage($id);
        $this->service->deleteImage($image);
        foreach (CacheReadRepository::cacheService() as $value) {
            \Yii::$app->cache->delete($value);
        }
        return[];
    }

    public function serializeListItem(Service $service)
    {
        return ServiceList::serializeListItem($service);
    }
}
