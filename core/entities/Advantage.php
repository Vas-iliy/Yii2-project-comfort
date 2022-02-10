<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Advantage extends ActiveRecord
{
    public static function tableName()
    {
        return 'advantages';
    }
}