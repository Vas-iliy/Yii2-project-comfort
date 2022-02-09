<?php

namespace core\entities;

use yii\db\ActiveRecord;

class About extends ActiveRecord
{
    public static function tableName()
    {
        return 'about_us';
    }
}