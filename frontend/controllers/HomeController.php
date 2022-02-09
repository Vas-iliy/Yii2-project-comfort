<?php

namespace frontend\controllers;


use core\repositories\frontend\AboutRepository;
use core\repositories\frontend\FilterRepository;
use core\repositories\frontend\ProjectRepository;

class HomeController extends AppControllers
{
    public $contacts;
    private $filters;
    private $projects;
    private $about_us;

    public function __construct($id, $module, FilterRepository $filters, ProjectRepository $projects, AboutRepository $about_us, $config = [])
    {
        $this->filters = $filters;
        $this->projects = $projects;
        $this->about_us = $about_us;
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
        return $this->render('about', compact('states'));
    }
}