<?php

namespace frontend\controllers;


use core\forms\frontend\ReviewForm;
use core\repositories\frontend\AboutRepository;
use core\repositories\frontend\FilterRepository;
use core\repositories\frontend\ProjectRepository;
use core\services\ReviewService;
use Yii;

class HomeController extends AppControllers
{
    public $contacts;
    private $filters;
    private $projects;
    private $about_us;
    private $service;

    public function __construct($id, $module, FilterRepository $filters, ProjectRepository $projects, AboutRepository $about_us, ReviewService $service, $config = [])
    {
        $this->filters = $filters;
        $this->projects = $projects;
        $this->about_us = $about_us;
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('home');
        $filters = $this->filters->getFilter();
        $projects = $this->projects->getProjectPopular();
        return $this->render('index', compact('filters', 'projects'));
    }

    public function actionAbout()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('about');
        $states = $this->about_us->getStates();
        $model = new ReviewForm();
        if ($model->load($this->request->post()) && $model->validate()) {
            try {
                $this->service->create($model);
                Yii::$app->session->setFlash('success', 'Review accepted.');
                return $this->refresh();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('about', compact('states', 'model'));
    }
}