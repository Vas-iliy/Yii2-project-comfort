<?php

namespace core\repositories;

use core\entities\WorkImage;
use yii\web\NotFoundHttpException;

class WorkImageRepository
{
    public function getAll()
    {
        $images = \Yii::$app->cache->get('work_images');
        if (empty($images)) {
            if (!$images = WorkImage::find()->all()) throw new NotFoundHttpException('Not found.');
            \Yii::$app->cache->set('work_images', $images, 3600*24*30);
        }
        return $images;
    }
}