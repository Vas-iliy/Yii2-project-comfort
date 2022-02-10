<?php

namespace core\repositories\frontend;

use core\entities\Work;

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
}