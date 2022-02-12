<?php

namespace frontend\controllers;

use core\repositories\frontend\FilterRepository;
use core\repositories\frontend\PageRepository;
use core\repositories\frontend\ProjectRepository;
use yii\data\Pagination;

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
        $filters = $this->filters->getFilters();
        $isActive = $this->filters->countFilters($this->request->get('filter'));
        if ((is_array($isActive) && count($isActive) == 0)){
            return $this->redirect('project');
        }
        $projects = $this->projects->pagination($this->projects->getProjects($isActive));

        return $this->render('index', compact('filters', 'isActive', 'projects'));
    }

}