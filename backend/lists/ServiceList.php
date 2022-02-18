<?php

namespace backend\lists;

use core\entities\Filter;
use core\entities\Material;
use core\entities\Project;
use core\entities\ProjectImage;
use core\entities\Service;
use core\entities\ServiceImage;
use core\forms\ProjectFrom;
use core\forms\ServiceFrom;
use core\helpers\StatusHelper;
use yii\helpers\Json;
use yii\helpers\Url;

class ServiceList
{
    public static function serializeListItem(Service $service)
    {
        return [
            'id' => $service->id,
            'title' => $service->title,
            'description' => $service->description,
            'items' => array_filter(Json::decode($service->getAttribute('items_json'))),
            'status' => StatusHelper::status($service->status, new Service()),
            'images' => array_map(function (ServiceImage $image) {
                return $image->getThumbFileUrl('image', 'catalog_list');
            }, $service->images),
        ];
    }

    public static function formService(ServiceFrom $form)
    {
        return [
            'title' => $form->title,
            'description' => $form->description,
            'textItems' => $form->textItems,
            'status' => $form->status,
        ];
    }
}