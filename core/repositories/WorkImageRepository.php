<?php

namespace core\repositories;

use core\entities\WorkImage;
use core\repositories\Repository;

class WorkImageRepository extends Repository
{
    public function getImages()
    {
        $images = \Yii::$app->cache->get('works_images');
        if (empty($images)) {
            $images = $this->getAll(new WorkImage());
            \Yii::$app->cache->set('works_images', $images, 3600*24*30);
        }
        return $images;
    }
}