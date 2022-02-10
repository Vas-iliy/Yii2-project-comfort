<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Question extends ActiveRecord
{
    public static function tableName()
    {
        return 'questions';
    }
}