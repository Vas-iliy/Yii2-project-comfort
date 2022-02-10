<?php

namespace core\repositories\frontend;

use core\entities\State;

class StateRepository extends Repository
{
    public function getState($id)
    {
        $state = \Yii::$app->cache->get("state_$id");
        if (empty($state)) {
            $state = $this->get($id, new State());
            \Yii::$app->cache->set("projects_$id", $state, 3600*24*30);
        }
        return $state;
    }
}