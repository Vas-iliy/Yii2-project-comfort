<?php

namespace frontend\controllers;


use core\repositories\frontend\FilterRepository;

class HomeController extends AppControllers
{
    public $contacts;
    private $filters;

    public function __construct($id, $module, FilterRepository $filters, $config = [])
    {
        $this->filters = $filters;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('home');
        $filters = $this->filters->getFilter();
        return $this->render('index', compact('filters'));
    }
}