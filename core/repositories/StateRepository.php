<?php

namespace core\repositories;

use core\entities\State;

class StateRepository
{
    public function get($id)
    {
        $state = \Yii::$app->cache->get("state_$id");
        if (empty($state)) {
            $state = State::find()->andWhere(['status' => State::STATUS_ACTIVE])->limit(1)->one();
            \Yii::$app->cache->set("projects_$id", $state, 3600*24*30);
        }
        return $state;
    }
}