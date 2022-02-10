<?php

namespace core\repositories\frontend;

use core\entities\About;
use core\helpers\TitleHelper;
use yii\web\NotFoundHttpException;

class AboutRepository
{
    public function getStates()
    {
        $about = \Yii::$app->cache->get('about_states');
        if (empty($about)) {
            $about = About::find()->all();
            $about = TitleHelper::editTitle($about);
            \Yii::$app->cache->set('about_states', $about, 3600*24*30);
        }
        return $about;
    }
}