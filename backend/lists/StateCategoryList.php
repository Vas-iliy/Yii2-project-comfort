<?php

namespace backend\lists;

use core\entities\StateCategory;
use core\forms\StateCategoryFrom;
use core\helpers\StatusHelper;

class StateCategoryList
{
    public static function serializeListItem(StateCategory $category)
    {
        return [
            'id' => $category->id,
            'title' => $category->title,
            'status' => StatusHelper::status($category->status, new StateCategory())
        ];
    }

    public static function formCategory(StateCategoryFrom $form)
    {
        return [
            'title' => $form->title,
            'status' => $form->status
        ];
    }
}