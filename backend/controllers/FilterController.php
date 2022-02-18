<?php

namespace backend\controllers;

use backend\lists\FilterList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\Filter;
use core\forms\FilterForm;
use core\readModels\CacheReadRepository;
use core\readModels\FilterReadRepository;
use core\services\FilterService;
use yii\rest\Controller;

class FilterController extends Controller
{
    private $filters;
    private $service;

    public function __construct($id, $module, FilterReadRepository $filters, FilterService $service, $config = [])
    {
        $this->filters = $filters;
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
        $filters = $this->filters->getAll();
        return new MapDataProvider($filters, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new FilterForm();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheFilter());
        return [
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $filter = $this->filters->find($id);
        $form = new FilterForm($filter);
        AppController::actionUpdate($form, $this->service, $filter->id, CacheReadRepository::cacheFilter());
        return [
            'errors' => $form->errors,
            'filter' => FilterList::formFilter($form),
            'image' => $filter->getThumbFileUrl('image', 'catalog_list'),
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheFilter());
        return [];
    }

    public function serializeListItem(Filter $filter)
    {
        return FilterList::serializeListItem($filter);
    }
}
