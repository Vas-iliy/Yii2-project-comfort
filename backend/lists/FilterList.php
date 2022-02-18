<?php

namespace backend\lists;

use core\entities\Filter;
use core\forms\FilterForm;
use core\helpers\StatusHelper;

class FilterList
{
    public static function serializeListItem(Filter $filter)
    {
        return [
            'id' => $filter->id,
            'title' => $filter->filter,
            'status' => StatusHelper::status($filter->status, new Filter()),
            'image' => $filter->getThumbFileUrl('image', 'catalog_list')
        ];
    }

    public static function formFilter(FilterForm $form)
    {
        return [
            'filter' => $form->filter,
            'top' => $form->top,
            'status' => $form->status
        ];
    }
}