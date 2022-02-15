<?php

namespace core\repositories;

use core\entities\Material;
use yii\web\NotFoundHttpException;

class MaterialRepository
{
    public function getAll()
    {
        $materials = \Yii::$app->cache->get('materials');
        if (empty($materials)) {
            if (!$materials = Material::find()->andWhere(['status' => Material::STATUS_ACTIVE])->asArray()->all()) throw new NotFoundHttpException('Not found.');
            \Yii::$app->cache->set('materials', $materials, 3600*24*30*12);
        }
        return $materials;
    }
}