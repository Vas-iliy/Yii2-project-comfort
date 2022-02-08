<?php

namespace frontend\controllers;

use frontend\controllers\AppControllers;

class HomeController extends AppControllers
{
    public $contacts;

    public function actionIndex()
    {
        $this->contacts = $this->getContact();
        return $this->render('index');
    }

}