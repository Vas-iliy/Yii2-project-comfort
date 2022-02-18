<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yii\helpers\Json;

class ServicePoint extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $items;

    public static function tableName()
    {
        return 'service_points';
    }

    public static function create($title, $items, $description, $service, $status)
    {
        $point = new static();
        $point->title = $title;
        $point->description = $description;
        $point->items = $items;
        $point->service_id = $service;
        $point->status = $status ? $status : ServicePoint::STATUS_INACTIVE;
        return $point;
    }

    public function edit($title, $items, $description, $service, $status)
    {
        $this->title = $title;
        $this->description = $description;
        $this->items = $items;
        $this->service_id = $service;
        $this->status = $status ? $status : ServicePoint::STATUS_INACTIVE;

    }
    
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    public function afterFind()
    {
        $this->items = array_filter(Json::decode($this->getAttribute('items_json')));
        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        $this->setAttribute('items_json', Json::encode(array_filter($this->items)));
        return parent::beforeSave($insert);
    }
}