<?php

namespace core\repositories\frontend;

use core\entities\Filter;
use yii\web\NotFoundHttpException;

class FilterRepository
{
    public function getFilter()
    {
        if (!$filters = Filter::find()->andWhere(['top' => 1])->limit(6)->orderBy('order')->all()) {
            throw new NotFoundHttpException('No contacts.');
        }
        return $filters;
    }

}