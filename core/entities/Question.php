<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Question extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return 'questions';
    }
}