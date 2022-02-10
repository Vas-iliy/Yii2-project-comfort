<?php

namespace core\entities;

use yii\db\ActiveRecord;

class ServicePoint extends ActiveRecord
{
    public static function tableName()
    {
        return 'service_points';
    }
}