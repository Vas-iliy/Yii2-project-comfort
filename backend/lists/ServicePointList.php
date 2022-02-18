<?php

namespace backend\lists;

use core\entities\Service;
use core\entities\ServicePoint;
use core\forms\ServicePointFrom;
use core\helpers\StatusHelper;
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
            'status' => StatusHelper::status($point->status, new ServicePoint())

        ];
    }

    public static function serializeListService(ServicePoint $point)
    {
        return [
            'id' => $point->id,
            'title' => $point->title,
            'description' => $point->description,
            'items' => array_filter(Json::decode($point->getAttribute('items_json'))),
            'status' => StatusHelper::status($point->status, new ServicePoint())
        ];
    }

    public static function formListService(Service $service)
    {
        return [
            'id' => $service->id,
            'title' => $service->title
        ];
    }


    public static function formService(ServicePointFrom $form)
    {
        return [
            'title' => $form->title,
            'description' => $form->description,
            'service' => $form->service,
            'textItems' => $form->textItems,
            'status' => $form->status
        ];
    }
}