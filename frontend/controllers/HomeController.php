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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'foreColor' => 0xFE980F, // цвет символов
                'minLength' => 5, // минимальное количество символов
                'maxLength' => 8, // максимальное
                'offset' => 10, // расстояние между символами (можно отрицательное)
            ],
        ];
    }

    public function actionIndex()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('');
        $this->setMeta('Главная');
        $filters = $this->filters->getFilter();
        $projects = $this->projects->getProjectPopular();
        return $this->render('index', compact('filters', 'projects'));
    }

    public function actionAbout()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('home/about');
        $this->setMeta('О компании');
        $states = $this->about_us->getAll();
        $images = $this->contactImages->getContacts();
        $model = new ReviewForm();
        return $this->render('about', compact('states', 'model', 'images'));
    }
}