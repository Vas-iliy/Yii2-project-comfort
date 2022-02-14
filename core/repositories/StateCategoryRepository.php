<?php


namespace core\repositories;


use core\entities\StateCategory;
use core\helpers\TitleHelper;
use core\repositories\Repository;

class StateCategoryRepository extends Repository
{
    public function getCategoryStates()
    {
        $states = \Yii::$app->cache->get('states');
        if (empty($states)) {
            $states = $this->getAll(new StateCategory());
            $states = TitleHelper::editTitle($states);
            \Yii::$app->cache->set('states', $states, 3600*24*30);
        }
        return $states;
    }
}