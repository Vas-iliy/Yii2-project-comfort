<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yii\helpers\Json;

class ServicePoint extends ActiveRecord
{
    public $items;
    public static function tableName()
    {
        return 'service_points';
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