<?php

namespace core\entities;

use yii\db\ActiveRecord;

class Project extends ActiveRecord
{
    public static function tableName()
    {
        return 'projects';
    }

    public function getImages()
    {
        return $this->hasMany(ProjectImage::class, ['project_id' => 'id']);
    }
}