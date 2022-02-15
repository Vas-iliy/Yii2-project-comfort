<?php

namespace core\repositories;

use core\entities\Work;

class WorkRepository
{
    public function getTexts()
    {
        $work = \Yii::$app->cache->get('work_text');
        if (empty($work)) {
            $work = Work::find()->andWhere(['status' => Work::STATUS_ACTIVE])->limit(1)->one();
            \Yii::$app->cache->set('work_text', $work, 3600*24*30);
        }
        return $work;
    }
}