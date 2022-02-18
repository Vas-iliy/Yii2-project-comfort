<?php

namespace backend\controllers;

use backend\lists\AboutList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\About;
use core\forms\AboutFrom;
use core\readModels\AboutReadRepository;
use core\readModels\CacheReadRepository;
use core\services\AboutService;
use yii\rest\Controller;

class QuestionController extends Controller
{
    private $abouts;
    private $service;

    public function __construct($id, $module, AboutReadRepository $abouts, AboutService $service, $config = [])
    {
        $this->abouts = $abouts;
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
        $abouts= $this->abouts->getAll();
        return new MapDataProvider($abouts, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new AboutFrom();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheAbout());
        return [
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $about = $this->abouts->find($id);
        $form = new AboutFrom($about);
        AppController::actionUpdate($form, $this->service, $about->id, CacheReadRepository::cacheAbout());
        return [
            'about' => AboutList::formContact($form),
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheAbout());
        return [];
    }

    public function serializeListItem(About $about)
    {
        return AboutList::serializeListItem($about);
    }
}
