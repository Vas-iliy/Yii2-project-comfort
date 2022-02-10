<?php

namespace core\entities;

use yii\db\ActiveRecord;

class StateCategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'states_category';
    }

    public function getStates()
    {
        return $this->hasMany(State::class, ['category_id' => 'id']);
    }
}