<?php

namespace core\repositories;

use core\entities\Service;
use core\helpers\TitleHelper;
use core\repositories\Repository;

class ServiceRepository extends Repository
{
    public function getServices()
    {
        $services = \Yii::$app->cache->get('services');
        if (empty($services)) {
            $services = $this->getAll(new Service());
            $services = TitleHelper::editTitle($services);
            \Yii::$app->cache->set('services', $services, 3600*24*30);
        }
        return $services;
    }
}