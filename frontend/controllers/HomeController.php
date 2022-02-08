<?php

namespace frontend\controllers;


use core\repositories\frontend\FilterRepository;
use core\repositories\frontend\ProjectRepository;

class HomeController extends AppControllers
{
    public $contacts;
    private $filters;
    private $projects;

    public function __construct($id, $module, FilterRepository $filters, ProjectRepository $projects, $config = [])
    {
        $this->filters = $filters;
        $this->projects = $projects;
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
}