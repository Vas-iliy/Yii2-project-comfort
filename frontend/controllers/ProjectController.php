<?php

namespace frontend\controllers;

use core\repositories\FilterRepository;
use core\repositories\PageRepository;
use core\repositories\ProjectRepository;

class ProjectController extends AppControllers
{
    private $filters;
    private $projects;

    public function __construct($id, $module, PageRepository $pages, FilterRepository $filters, ProjectRepository $projects, $config = [])
    {
        $this->filters = $filters;
        $this->projects = $projects;
        parent::__construct($id, $module, $pages, $config);
    }

    public function actionIndex()
    {
        $this->page = $this->getPage('project');
        $this->contacts = $this->getContact();
        $this->setMeta('Projects');
        $filters = $this->filters->getAll();
        $isActive = FilterRepository::countFilters($this->request->get('filter'));
        $projects = $this->projects->pagination($this->projects->getProjects($isActive));
        return $this->render('index', compact('filters', 'isActive', 'projects'));
    }

}