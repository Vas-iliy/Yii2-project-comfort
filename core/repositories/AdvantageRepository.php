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

    public function remove(Advantage $advantage)
    {
        $advantage->status = $advantage::STATUS_DELETED;
        if (!$advantage->save()) throw new \RuntimeException('Removing error.');
    }

    public function get($id)
    {
        if (!$advantage = Advantage::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $advantage;
    }

    public function save($advantage)
    {
        if (!$return = $advantage->save()) throw new \RuntimeException('Saving error.');
        return $return;
    }
}