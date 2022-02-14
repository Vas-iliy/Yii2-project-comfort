<?php

namespace frontend\controllers;


use core\forms\frontend\ClientForm;
use core\forms\frontend\ReviewForm;
use core\repositories\AboutRepository;
use core\repositories\ContactImageRepository;
use core\repositories\FilterRepository;
use core\repositories\PageRepository;
use core\repositories\ProjectRepository;

class HomeController extends AppControllers
{
    private $filters;
    private $projects;
    private $about_us;
    private $contactImages;

    public function __construct($id, $module, PageRepository $pages, FilterRepository $filters, ProjectRepository $projects, AboutRepository $about_us, ContactImageRepository $contactImages, $config = [])
    {
        $this->filters = $filters;
        $this->projects = $projects;
        $this->about_us = $about_us;
        $this->contactImages = $contactImages;
        parent::__construct($id, $module, $pages, $config);
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['about'],
                'duration' => 3600*24*30,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('');
        $filters = $this->filters->getFilter();
        $projects = $this->projects->getProjectPopular();
        return $this->render('index', compact('filters', 'projects'));
    }

    public function actionAbout()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('home/about');
        $states = $this->about_us->getStates();
        $images = $this->contactImages->getContacts();
        $model = new ReviewForm();
        return $this->render('about', compact('states', 'model', 'images'));
    }
}