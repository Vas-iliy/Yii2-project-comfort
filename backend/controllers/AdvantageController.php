<?php

namespace backend\controllers;

use backend\lists\AdvantageList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\Advantage;
use core\forms\AdvantageFrom;
use core\readModels\AdvantageReadRepository;
use core\services\AdvantageService;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

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

    public function actionIndex()
    {
        $advantages= $this->advantages->getAll();
        return new MapDataProvider($advantages, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new AdvantageFrom();
        AppController::actionCreate($form, $this->service);
        return [
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $advantage = $this->findModel($id);
        $form = new AdvantageFrom($advantage);
        AppController::actionUpdate($form, $this->service, $advantage->id);
        return [
            'advantage' => AdvantageList::formContact($form),
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service);
        return [];
    }

    protected function findModel($id)
    {
        if (($model = Advantage::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function serializeListItem(Advantage $advantage)
    {
        return AdvantageList::serializeListItem($advantage);
    }
}