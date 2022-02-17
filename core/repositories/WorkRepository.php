<?php

namespace core\repositories;

use core\entities\Work;
use core\entities\WorkImage;
use yii\web\NotFoundHttpException;

class WorkRepository
{
    public function getTexts()
    {
        $work = \Yii::$app->cache->get('work_text');
        if (empty($work)) {
            $work = Work::find()->limit(1)->one();
            \Yii::$app->cache->set('work_text', $work, 3600*24*30);
        }
        return $work;
    }

    public function get($id)
    {
        if (!$work = Work::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $work;
    }

    public function save($work)
    {
        if (!$return = $work->save()) throw new \RuntimeException('Saving error.');
        return $return;
    }
}