<?php

namespace frontend\controllers;

use core\repositories\frontend\AdvantageRepository;
use core\repositories\frontend\PageRepository;
use core\repositories\frontend\ServiceRepository;
use core\repositories\frontend\WorkImageRepository;
use core\repositories\frontend\WorkRepository;

class ServiceController extends AppControllers
{
    private $services;
    private $advantages;
    private $workImages;
    private $workTexts;

    public function __construct($id, $module, PageRepository $pages, ServiceRepository $services, AdvantageRepository $advantages, WorkImageRepository $workImages, WorkRepository $workTexts, $config = [])
    {
        $this->services = $services;
        $this->advantages = $advantages;
        $this->workImages = $workImages;
        $this->workTexts = $workTexts;
        parent::__construct($id, $module, $pages, $config);
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 3600*24*30,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->page = $this->getPage('service');
        $services = $this->services->getServices();
        $advantage = $this->getPage('advantage');
        $advantages = $this->advantages->getAdvantages();
        $workImages = $this->workImages->getImages();
        $workTexts = $this->workTexts->getTexts();
        return $this->render('index', compact('services', 'advantage', 'advantages', 'workImages', 'workTexts'));
    }
}