<?php

namespace core\entities;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Client extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_ADMIN = 1;

    public static function tableName()
    {
        return 'clients';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function client($name, $phone, $material)
    {
        $client = new static();
        $client->name = $name;
        $client->phone = $phone;
        $client->material = $material;
        return $client;
    }


}