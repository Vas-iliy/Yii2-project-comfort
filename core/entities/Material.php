<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Material extends ActiveRecord
{
    public static function tableName()
    {
        return 'materials';
    }
}