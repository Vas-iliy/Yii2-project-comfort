<?php

namespace frontend\controllers;

use core\repositories\PageRepository;
use core\repositories\QuestionRepository;
use core\repositories\StateCategoryRepository;
use core\repositories\StateRepository;

class ArticleController extends AppControllers
{
    private $category;
    private $state;
    private $questions;

    public function __construct($id, $module, PageRepository $pages, StateCategoryRepository $category, StateRepository $state, QuestionRepository $questions, $config = [])
    {
        $this->category = $category;
        $this->state = $state;
        $this->questions = $questions;
        parent::__construct($id, $module, $pages, $config);
    }

    public function actionIndex()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('article');
        $this->setMeta('Articles');
        $categories = $this->category->getAll();
        $question = $this->getPage('article/question');
        return $this->render('index', compact('categories', 'question'));
    }

    public function actionState($id)
    {
        $this->page = $this->state->get($id);
        $this->setMeta('State');


        return $this->render('state', [
            'page' => $this->page,
        ]);
    }

    public function actionQuestion()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('article/question');
        $this->setMeta('Questions');

        $questions = $this->questions->getAll();
        return $this->render('question', compact('questions'));
    }
}