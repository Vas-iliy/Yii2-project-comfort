<?php

namespace core\readModels;

use core\entities\Service;
use core\entities\ServiceImage;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

class ServiceReadRepository
{
    public function getAll()
    {
        $query = Service::find()->with('points', 'images');
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return Service::findOne($id);
    }

    public function getImage($id)
    {
        if (!$service = ServiceImage::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $service;
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}