<?php

namespace frontend\controllers;

use core\repositories\frontend\AdvantageRepository;
use core\repositories\frontend\PageRepository;
use core\repositories\frontend\ServiceRepository;

class ServiceController extends AppControllers
{
    private $services;
    private $advantages;

    public function __construct($id, $module, PageRepository $pages, ServiceRepository $services, AdvantageRepository $advantages, $config = [])
    {
        $this->services = $services;
        $this->advantages = $advantages;
        parent::__construct($id, $module, $pages, $config);
    }

    public function actionIndex()
    {
        $this->page = $this->getPage('service');
        $services = $this->services->getServices();
        $advantage = $this->getPage('advantage');
        $advantages = $this->advantages->getAdvantages();
        return $this->render('index', compact('services', 'advantage', 'advantages'));
    }
}