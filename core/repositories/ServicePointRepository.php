<?php

namespace core\repositories;

use core\entities\Service;
use core\entities\ServiceImage;
use core\helpers\TitleHelper;
use yii\web\NotFoundHttpException;

class ServicePointRepository
{
    public function getAll()
    {
        $services = \Yii::$app->cache->get('services');
        if (empty($services)) {
            if (!$services = Service::find()->andWhere(['status' => Service::STATUS_ACTIVE])->all()) throw new NotFoundHttpException('Not found.');
            $services = TitleHelper::editTitle($services);
            \Yii::$app->cache->set('services', $services, 3600*24*30);
        }
        return $services;
    }

    public function save($service)
    {
        if (!$return = $service->save()) throw new \RuntimeException('Saving error.');
        return $return;
    }
    
    public function remove(Service $service)
    {
        $service->status = $service::STATUS_DELETED;
        if (!$service->save()) throw new \RuntimeException('Removing error.');
    }

    public function get($id)
    {
        if (!$service = Service::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $service;
    }
}