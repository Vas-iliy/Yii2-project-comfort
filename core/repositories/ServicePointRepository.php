<?php

namespace core\repositories;

use core\entities\ServicePoint;
use yii\web\NotFoundHttpException;

class ServicePointRepository
{
    public function save($point)
    {
        if (!$return = $point->save()) throw new \RuntimeException('Saving error.');
        return $return;
    }
    
    public function remove(ServicePoint $point)
    {
        $point->status = $point::STATUS_DELETED;
        if (!$point->save()) throw new \RuntimeException('Removing error.');
    }

    public function get($id)
    {
        if (!$point = ServicePoint::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $point;
    }
}