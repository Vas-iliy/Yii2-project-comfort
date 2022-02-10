<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Work extends ActiveRecord
{
    public static function tableName()
    {
        return 'works';
    }
}