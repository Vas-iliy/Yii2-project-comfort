<?php

namespace backend\controllers;

use backend\lists\AdvantageList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\Advantage;
use core\forms\AdvantageForm;
use core\readModels\AdvantageReadRepository;
use core\readModels\CacheReadRepository;
use core\services\AdvantageService;
use yii\rest\Controller;

class AdvantageController extends Controller
{
    private $advantages;
    private $service;

    public function __construct($id, $module, AdvantageReadRepository $advantages, AdvantageService $service, $config = [])
    {
        $this->advantages = $advantages;
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
        $advantages= $this->advantages->getAll();
        return new MapDataProvider($advantages, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new AdvantageForm();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheAdvantage());
        return [
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $advantage = $this->advantages->find($id);
        $form = new AdvantageForm($advantage);
        AppController::actionUpdate($form, $this->service, $advantage->id, CacheReadRepository::cacheAdvantage());
        return [
            'advantage' => AdvantageList::formContact($form),
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheAdvantage());
        return [];
    }

    public function serializeListItem(Advantage $advantage)
    {
        return AdvantageList::serializeListItem($advantage);
    }
}
