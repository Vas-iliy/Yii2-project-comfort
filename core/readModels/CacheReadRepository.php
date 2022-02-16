<?php

namespace core\readModels;

use core\entities\Filter;

class CacheReadRepository
{
    public static function cacheProject()
    {
        $cache = [];
        $filters = Filter::find()->select('id')->andWhere(['status' => Filter::STATUS_ACTIVE])->asArray()->all();
        foreach ($filters as $filter) $cache[] = $filter['id'];
        foreach (self::fillArray($cache) as $value) $cache[] = $value;
        foreach ($cache as $value) $cache = 'projects_' . $value;
        $cache[] = 'projects'; $cache[] = ['yii\widgets\FragmentCache', 'projects_home_page'];
        return $cache;
    }

    public static function cacheContact()
    {
        return ['contact'];
    }

    public static function cacheAdvantage()
    {
        return ['advantages', ['yii\widgets\FragmentCache', 'service/index']];
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