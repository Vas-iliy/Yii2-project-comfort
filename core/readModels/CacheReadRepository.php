<?php

namespace core\readModels;

use core\entities\Filter;
use core\entities\State;

class CacheReadRepository
{
    public static function cacheProject()
    {
        $cache = [];
        $return = [];
        $filters = Filter::find()->select('id')->andWhere(['status' => Filter::STATUS_ACTIVE])->asArray()->all();
        if (!empty($filters)) {
            foreach ($filters as $filter) $cache[] = $filter['id'];
            foreach (self::fillArray($cache) as $value) $cache[] = $value;
            foreach ($cache as $value) $return[] = 'projects_' . $value;
        }
        $return[] = 'projects'; $return[] = ['yii\widgets\FragmentCache', 'projects_home_page'];
        return $return;
    }

    public static function cacheState()
    {
        $return = [];
        $states= State::find()->select('id')->andWhere(['status' => State::STATUS_ACTIVE])->asArray()->all();
        if (!empty($states)) {
            foreach ($states as $state) $return[] = 'state_' . $state['id'];
        }
        return $return;
    }

    public static function cacheContact()
    {
        return ['contact'];
    }

    public static function cacheAdvantage()
    {
        return ['advantages', ['yii\widgets\FragmentCache', 'service/index']];
    }

    public static function cacheWork()
    {
        return ['work_text', 'work_images', ['yii\widgets\FragmentCache', 'service/index']];
    }

    public static function cacheService()
    {
        return ['services', ['yii\widgets\FragmentCache', 'service/index']];
    }

    public static function cacheAbout()
    {
        return ['about_states', ['yii\widgets\FragmentCache', 'about_page']];
    }

    public static function cacheQuestion()
    {
        return ['questions', ['yii\widgets\FragmentCache', 'questions_page']];
    }

    public static function cacheCategory()
    {
        return ['states', ['yii\widgets\FragmentCache', 'states_page']];
    }

    public static function cacheFilter()
    {
        return ['filter_home', 'filters', ['yii\widgets\FragmentCache', 'filters_home_page']];
    }

    public static function cacheMaterial()
    {
        return ['materials'];
    }

    private static function fillArray($incomeArr) {
        $outcomeArr = [];
        $firstLetter = $incomeArr[0];
        $incomeArr = array_slice($incomeArr, 1);
        for( $i = 0; $i < sizeof($incomeArr); $i++ ) {
            $outcomeArr[] = $firstLetter . ',' . $incomeArr[$i];
        }

        if (sizeof($incomeArr) > 1) {
            $outcomeArr = array_merge($outcomeArr, self::fillArray($incomeArr));
        }
        return $outcomeArr;
    }
}