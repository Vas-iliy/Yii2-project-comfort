<?php

namespace frontend\controllers;

use core\repositories\frontend\FilterRepository;
use core\repositories\frontend\PageRepository;

class ProjectController extends AppControllers
{
    private $filters;

    public function __construct($id, $module, PageRepository $pages, FilterRepository $filters, $config = [])
    {
        $this->filters = $filters;
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
        return $this->render('index', compact('filters', 'isActive'));
    }

}