<?php

namespace core\repositories;

use core\entities\Advantage;
use yii\web\NotFoundHttpException;

class AdvantageRepository
{
    public function getAll()
    {
        $advantages = \Yii::$app->cache->get('advantages');
        if (empty($advantages)) {
            if (!$advantages = Advantage::find()->andWhere(['status' => Advantage::STATUS_ACTIVE])->asArray()->all()) throw new NotFoundHttpException('Not found.');
            \Yii::$app->cache->set('advantages', $advantages, 3600*24*30*12);
        }
        return $advantages;
    }
}