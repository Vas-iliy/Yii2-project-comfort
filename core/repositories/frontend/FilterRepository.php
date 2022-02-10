<?php

namespace core\repositories\frontend;

use core\entities\Filter;
use yii\web\NotFoundHttpException;

class FilterRepository
{
    public function getFilter()
    {
        $filters = \Yii::$app->cache->get('filter_home');
        if (empty($filters)) {
            $filters = Filter::find()->andWhere(['top' => 1])->limit(6)->orderBy('order')->all();
            \Yii::$app->cache->set('filter_home', $filters, 3600*24*30);
        }
        return $filters;
    }

}