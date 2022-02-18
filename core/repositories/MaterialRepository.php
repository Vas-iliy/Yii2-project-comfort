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

    public function remove(Material $material)
    {
        $material->status = $material::STATUS_DELETED;
        if (!$material->save()) throw new \RuntimeException('Removing error.');
    }

    public function get($id)
    {
        if (!$material = Material::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $material;
    }

    public function save($material)
    {
        if (!$return = $material->save()) throw new \RuntimeException('Saving error.');
        return $return;
    }
}