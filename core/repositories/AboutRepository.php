<?php

namespace core\repositories;

use core\entities\About;
use core\helpers\TitleHelper;
use yii\web\NotFoundHttpException;

class AboutRepository
{
    public function getAll()
    {
        $about = \Yii::$app->cache->get('about_states');
        if (empty($about)) {
            if (!$about = About::find()->andWhere(['status' => About::STATUS_ACTIVE])->all()) throw new NotFoundHttpException('Not found.');
            $about = TitleHelper::editTitle($about);
            \Yii::$app->cache->set('about_states', $about, 3600*24*30);
        }
        return $about;
    }
}