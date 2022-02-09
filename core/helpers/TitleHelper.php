<?php

namespace core\helpers;

class TitleHelper
{
    public static function editTitle($states)
    {
        foreach ($states as $state) {
            $state->title = self::getItemArray($state->title);
        }
        return $states;
    }

    private static function getItemArray($title)
    {
        $arr = explode(' ',trim($title));
        if (count($arr) > 3) {
            $j = floor(count($arr)/2);
            for ($i = count($arr) - $j; $i < count($arr); $i++) {
                $arr[$i] = self::stringSpan($arr[$i]);
            }
        } elseif (1 < count($arr) && count($arr) <= 3 ) {
            $arr[count($arr)-1] = self::stringSpan($arr[count($arr)-1]);
        }
        return trim(implode(' ', $arr));
    }

    private static function stringSpan($string)
    {
        return "<span class='color-text'>$string</span>";
    }
}