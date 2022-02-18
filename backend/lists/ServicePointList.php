<?php

namespace backend\lists;

use core\entities\ServicePoint;
use core\forms\ServicePointFrom;
use yii\helpers\Json;

class ServicePointList
{
    public static function serializeListItem(ServicePoint $point)
    {
        return [
            'id service' => $point->service->id,
            'title service' => $point->service->title,
            'id' => $point->id,
            'title' => $point->title,
            'description' => $point->description,
            'items' => array_filter(Json::decode($point->getAttribute('items_json'))),
        ];
    }

    public static function formService(ServicePointFrom $form)
    {
        return [
            'title' => $form->title,
            'description' => $form->description,
            'textItems' => $form->textItems,
            'service' => [
                'id' => $form->service->id,
                'title' => $form->service->title,
            ],
        ];
    }
}