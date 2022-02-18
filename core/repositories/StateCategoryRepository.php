<?php

namespace core\repositories;

use core\entities\StateCategory;
use core\helpers\TitleHelper;
use yii\web\NotFoundHttpException;

class StateCategoryRepository
{
    public function getAll()
    {
        $categories = \Yii::$app->cache->get('states');
        if (empty($categories)) {
            if (!$categories = StateCategory::find()->andWhere(['status' => StateCategory::STATUS_ACTIVE])->all()) throw new NotFoundHttpException('Not found.');
            $categories = TitleHelper::editTitle($categories);
            \Yii::$app->cache->set('states', $categories, 3600*24*30);
        }
        return $categories;
    }
}