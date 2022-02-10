<?php

namespace frontend\controllers;

use core\repositories\frontend\PageRepository;
use core\repositories\frontend\StateCategoryRepository;
use core\repositories\frontend\StateRepository;

class ArticleController extends AppControllers
{
    private $category;
    private $state;

    public function __construct($id, $module, PageRepository $pages, StateCategoryRepository $category, StateRepository $state, $config = [])
    {
        $this->category = $category;
        $this->state = $state;
        parent::__construct($id, $module, $pages, $config);
    }

    public function actionIndex()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('article');
        $categories = $this->category->getCategoryStates();
        return $this->render('index', compact('categories'));
    }

    public function actionState($id)
    {
        $this->page = $this->state->getState($id);

        return $this->render('state', [
            'page' => $this->page,
        ]);
    }
}