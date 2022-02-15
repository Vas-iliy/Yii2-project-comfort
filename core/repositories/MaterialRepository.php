<?php

namespace core\repositories;

use core\entities\Material;

class MaterialRepository extends Repository
{
    public function getMaterials()
    {
        $materials = \Yii::$app->cache->get('materials');
        if (empty($materials)) {
            $materials = $this->getAllArray(new Material());
            \Yii::$app->cache->set('materials', $materials, 3600*24*30*12);
        }
        return $materials;
    }
}