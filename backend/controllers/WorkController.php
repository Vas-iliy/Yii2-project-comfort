<?php

namespace backend\controllers;

use core\entities\workImage;
use core\forms\WorkForm;
use core\readModels\CacheReadRepository;
use core\readModels\workReadRepository;
use core\services\workService;
use yii\helpers\Url;
use yii\rest\Controller;

class WorkController extends Controller
{
    private $works;
    private $service;

    public function __construct($id, $module, WorkReadRepository $works, WorkService $service, $config = [])
    {
        $this->works = $works;
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function verbs(): array
    {
        return [
            'index' => ['GET'],
            'update' => ['GET', 'PUT', 'PATCH'],
            'delete-image' => ['DELETE'],
        ];
    }

    public function actionIndex()
    {
        $work = $this->works->get();
        return [
            'description' => $work->description,
            'images' => array_map(function (WorkImage $image) {
                return $image->getThumbFileUrl('image', 'catalog_list');
            }, $work->images),
        ];
    }

    public function actionUpdate($id)
    {
        $work = $this->works->find($id);
        $form = new WorkForm($work);
        AppController::actionUpdate($form, $this->service, $work->id, CacheReadRepository::cacheWork());
        return [
            'errors' => $form->errors,
            'work' => ['description' => $form->description],
            'images' => array_map(function (WorkImage $image) {
                return [
                    'image' => $image->getThumbFileUrl('image', 'catalog_list'),
                    '_links' => ['href' => Url::to(['delete-image', 'id' => $image->id], true)]
                ];
            }, $work->images),
        ];
    }

    public function actionDeleteImage($id)
    {
        $image = $this->works->getImage($id);
        $this->service->deleteImage($image);
        foreach (CacheReadRepository::cacheWork() as $value) {
            \Yii::$app->cache->delete($value);
        }
        return[];
    }
}
