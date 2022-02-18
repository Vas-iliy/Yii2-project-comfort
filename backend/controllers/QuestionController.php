<?php

namespace backend\controllers;

use backend\lists\AboutList;
use backend\lists\QuestionList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\About;
use core\entities\Question;
use core\forms\AboutFrom;
use core\forms\QuestionFrom;
use core\readModels\AboutReadRepository;
use core\readModels\CacheReadRepository;
use core\readModels\QuestionReadRepository;
use core\services\AboutService;
use core\services\QuestionService;
use yii\rest\Controller;

class QuestionController extends Controller
{
    private $questions;
    private $service;

    public function __construct($id, $module, QuestionReadRepository $questions, QuestionService $service, $config = [])
    {
        $this->questions = $questions;
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
        $questions= $this->questions->getAll();
        return new MapDataProvider($questions, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new QuestionFrom();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheQuestion());
        return [
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $question = $this->questions->find($id);
        $form = new QuestionFrom($question);
        AppController::actionUpdate($form, $this->service, $question->id, CacheReadRepository::cacheQuestion());
        return [
            'about' => QuestionList::formQuestion($form),
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheQuestion());
        return [];
    }

    public function serializeListItem(Question $question)
    {
        return QuestionList::serializeListItem($question);
    }
}
