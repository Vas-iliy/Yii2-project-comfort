<?php

namespace frontend\controllers;


class HomeController extends AppControllers
{
    public $contacts;

    public function actionIndex()
    {
        $this->contacts = $this->getContact();
        $this->page = $this->getPage('home');
        return $this->render('index');
    }
}