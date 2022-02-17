<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Work extends ActiveRecord
{
    public static function tableName()
    {
        return 'works';
    }
    
    public function edit($description)
    {
        $this->description = $description;
    }

    public function getImages()
    {
        return $this->hasMany(WorkImage::class, ['work_id' => 'id']);
    }
}