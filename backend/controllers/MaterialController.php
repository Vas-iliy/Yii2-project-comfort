<?php

namespace backend\controllers;

use backend\lists\ContactList;
use backend\lists\MaterialList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\Contact;
use core\entities\Material;
use core\forms\ContactForm;
use core\forms\MaterialForm;
use core\readModels\CacheReadRepository;
use core\readModels\ContactReadRepository;
use core\readModels\MaterialReadRepository;
use core\services\ContactService;
use core\services\MaterialService;
use yii\rest\Controller;

class MaterialController extends Controller
{
    private $materials;
    private $service;

    public function __construct($id, $module, MaterialReadRepository $materials, MaterialService $service, $config = [])
    {
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
        $materials= $this->materials->getAll();
        return new MapDataProvider($materials, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new MaterialForm();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheMaterial());
        return [
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $material = $this->materials->find($id);
        $form = new MaterialForm($material);
        AppController::actionUpdate($form, $this->service, $material->id, CacheReadRepository::cacheMaterial());
        return [
            'contact' => MaterialList::formMaterial($form),
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheMaterial());
        return [];
    }

    public function serializeListItem(Material $material)
    {
        return MaterialList::serializeListItem($material);
    }
}
