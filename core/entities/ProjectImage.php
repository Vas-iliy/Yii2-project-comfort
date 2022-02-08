<?php

namespace core\entities;

use yii\db\ActiveRecord;

class ProjectImage extends ActiveRecord
{
    public static function tableName()
    {
        return 'project_images';
    }
}