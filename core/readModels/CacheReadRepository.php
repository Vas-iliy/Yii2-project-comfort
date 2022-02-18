<?php

namespace core\readModels;

use core\entities\Filter;

class CacheReadRepository
{
    public static function cacheProject()
    {
        $cache = [];
        $return = [];
        $filters = Filter::find()->select('id')->andWhere(['status' => Filter::STATUS_ACTIVE])->asArray()->all();
        foreach ($filters as $filter) $cache[] = $filter['id'];
        foreach (self::fillArray($cache) as $value) $cache[] = $value;
        foreach ($cache as $value) $return[] = 'projects_' . $value;
        $return[] = 'projects'; $return[] = ['yii\widgets\FragmentCache', 'projects_home_page'];
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