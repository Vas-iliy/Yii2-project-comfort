<?php

namespace backend\controllers;

use backend\lists\StateCategoryList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\StateCategory;
use core\forms\StateCategoryForm;
use core\readModels\CacheReadRepository;
use core\readModels\StateCategoryReadRepository;
use core\services\StateCategoryService;
use yii\rest\Controller;

class StateCategoryController extends Controller
{
    private $categories;
    private $service;

    public function __construct($id, $module, StateCategoryReadRepository $categories, StateCategoryService $service, $config = [])
    {
        $this->categories = $categories;
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
        $categories= $this->categories->getAll();
        return new MapDataProvider($categories, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new StateCategoryForm();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheCategory());
        return [
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $category = $this->categories->find($id);
        $form = new StateCategoryForm($category);
        AppController::actionUpdate($form, $this->service, $category->id, CacheReadRepository::cacheCategory());
        return [
            'contact' => StateCategoryList::formCategory($form),
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheCategory());
        return [];
    }

    public function serializeListItem(StateCategory $category)
    {
        return StateCategoryList::serializeListItem($category);
    }
}
