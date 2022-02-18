<?php

namespace core\repositories;

use core\entities\State;
use yii\web\NotFoundHttpException;

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

    public function save($state)
    {
        if (!$return = $state->save()) throw new \RuntimeException('Saving error.');
        return $return;
    }

    public function remove(State $state)
    {
        $state->status = $state::STATUS_DELETED;
        if (!$state->save()) throw new \RuntimeException('Removing error.');
    }

    public function getState($id)
    {
        if (!$state = State::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $state;
    }
}