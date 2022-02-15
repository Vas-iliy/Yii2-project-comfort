<?php

namespace core\repositories;

use core\entities\Filter;
use yii\web\NotFoundHttpException;

class FilterRepository
{
    public function getFilter()
    {
        $filters = \Yii::$app->cache->get('filter_home');
        if (empty($filters)) {
            $filters = Filter::find()->andWhere(['top' => 1, 'status' => Filter::STATUS_ACTIVE])->limit(6)->orderBy('order')->all();
            \Yii::$app->cache->set('filter_home', $filters, 3600*24*30);
        }
        return $filters;
    }

    public function getAll()
    {
        $filters = \Yii::$app->cache->get('filters');
        if (empty($filters)) {
            if (!$filters = Filter::find()->andWhere(['status' => Filter::STATUS_ACTIVE])->asArray()->all()) throw new NotFoundHttpException('Not found.');
            \Yii::$app->cache->set('filters', $filters, 3600 * 24 * 30);
        }
        return $filters;
    }

    public function countFilters($filters)
    {
        if (preg_match('/,/', $filters)) {
            $arr = explode(',', $filters);
            $double = array_count_values($arr);
            foreach ($double as $k => $value) {
                if ($value > 1) {
                    $arr = array_unique($arr);
                    unset($arr[array_search($k,$arr)]);
                    $arr = array_values($arr);
                }
            }
            if (count($arr) == 1) {
                return $arr[0];
            }
            return $arr;
        }
        return $filters;
    }

}