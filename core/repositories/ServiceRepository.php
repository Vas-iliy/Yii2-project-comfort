<?php

namespace core\repositories;

use core\entities\Service;
use core\helpers\TitleHelper;
use yii\web\NotFoundHttpException;

class ServiceRepository
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
}