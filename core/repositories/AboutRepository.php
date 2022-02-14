<?php

namespace core\repositories;

use core\entities\About;
use core\helpers\TitleHelper;
use core\repositories\Repository;
use yii\web\NotFoundHttpException;

class AboutRepository extends Repository
{
    public function getStates()
    {
        $about = \Yii::$app->cache->get('about_states');
        if (empty($about)) {
            $about = $this->getAll(new About());
            $about = TitleHelper::editTitle($about);
            \Yii::$app->cache->set('about_states', $about, 3600*24*30);
        }
        return $about;
    }
}