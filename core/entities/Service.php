<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yii\helpers\Json;

class Service extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $items;

    public static function tableName()
    {
        return 'services';
    }

    public function getImages()
    {
        return $this->hasMany(ServiceImage::class, ['service_id' => 'id']);
    }

    public function getPoints()
    {
        return $this->hasMany(ServicePoint::class, ['service_id' => 'id']);
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