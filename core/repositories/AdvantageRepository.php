<?php

namespace core\repositories;

use core\entities\Advantage;
use core\repositories\Repository;

class AdvantageRepository extends Repository
{
    public function getAdvantages()
    {
        $advantages = \Yii::$app->cache->get('advantages');
        if (empty($advantages)) {
            $advantages = $this->getAllArray(new Advantage());
            \Yii::$app->cache->set('advantages', $advantages, 3600*24*30*12);
        }
        return $advantages;
    }
}