<?php

namespace core\repositories;

use core\entities\StateCategory;
use core\helpers\TitleHelper;
use yii\web\NotFoundHttpException;

class StateCategoryRepository
{
    public function getAll()
    {
        $states = \Yii::$app->cache->get('states');
        if (empty($states)) {
            if (!$states = StateCategory::find()->andWhere(['status' => StateCategory::STATUS_ACTIVE])->all()) throw new NotFoundHttpException('Not found.');
            $states = TitleHelper::editTitle($states);
            \Yii::$app->cache->set('states', $states, 3600*24*30);
        }
        return $states;
    }
}