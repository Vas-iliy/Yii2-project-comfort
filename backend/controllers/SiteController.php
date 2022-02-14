<?php

namespace backend\controllers;

use yii\rest\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return 'home';
    }
}
