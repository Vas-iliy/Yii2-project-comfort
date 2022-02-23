<?php

namespace frontend\controllers;

use core\repositories\AdvantageRepository;
use core\repositories\PageRepository;
use core\repositories\ServiceRepository;
use core\repositories\WorkImageRepository;
use core\repositories\WorkRepository;

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

    public function actionIndex()
    {
        $this->page = $this->getPage('service');
        $services = $this->services->getAll();
        $this->setMeta('Services');
        $advantage = $this->getPage('advantage');
        $advantages = $this->advantages->getAll();
        $workImages = $this->workImages->getAll();
        $workTexts = $this->workTexts->getTexts();
        return $this->render('index', compact('services', 'advantage', 'advantages', 'workImages', 'workTexts'));
    }
}