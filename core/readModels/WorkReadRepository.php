<?php

namespace core\readModels;

use core\entities\Work;
use core\entities\WorkImage;
use yii\web\NotFoundHttpException;

class WorkReadRepository
{
    public function get()
    {
        return Work::find()->limit(1)->one();
    }

    public function find($id)
    {
        return Work::findOne($id);
    }

    public function getImage($id)
    {
        if (!$work = WorkImage::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $work;
    }
}