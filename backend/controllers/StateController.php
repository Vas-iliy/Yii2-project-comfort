<?php

namespace backend\controllers;

use backend\lists\StateList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\State;
use core\entities\StateCategory;
use core\forms\StateForm;
use core\forms\StateUpdateForm;
use core\readModels\CacheReadRepository;
use core\readModels\StateCategoryReadRepository;
use core\readModels\StateReadRepository;
use core\services\StateService;
use yii\rest\Controller;

class StateController extends Controller
{
    private $states;
    private $categories;
    private $service;

    public function __construct($id, $module, StateReadRepository $states, StateCategoryReadRepository $categories, StateService $service, $config = [])
    {
        $this->states = $states;
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
        $states = $this->states->getAll();
        return new MapDataProvider($states, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new StateForm();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheCategory());
        return [
            'errors' => $form->errors,
            'categories' => new MapDataProvider($this->categories->getAll(), [$this, 'formListCategory']),
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $state = $this->states->find($id);
        $form = new StateUpdateForm($state);
        AppController::actionUpdate($form, $this->service, $state->id, CacheReadRepository::cacheCategory());
        return [
            'errors' => $form->errors,
            'state' => StateList::formState($form),
            'image' => $state->getThumbFileUrl('image', 'catalog_list'),
            'categories' => new MapDataProvider($this->categories->getAll(), [$this, 'formListCategory']),
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheCategory());
        return [];
    }

    public function serializeListItem(State $state)
    {
        return StateList::serializeListItem($state);
    }

    public function formListCategory(StateCategory $category)
    {
        return StateList::formListCategory($category);
    }
}
