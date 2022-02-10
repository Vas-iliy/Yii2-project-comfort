<?php

namespace frontend\controllers;

use core\repositories\frontend\PageRepository;

class ArticleController extends AppControllers
{
    public function __construct($id, $module, PageRepository $pages, $config = [])
    {
        parent::__construct($id, $module, $pages, $config);
    }

    public function actionIndex()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('article');
        return $this->render('index');
    }
}