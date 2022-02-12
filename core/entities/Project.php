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

    public function getMaterial()
    {
        return $this->hasOne(Material::class, ['id' => 'material_id']);
    }

    public function getFilters()
    {
        return $this->hasMany(Filter::class, ['id' => 'filter_id'])
            ->viaTable('projects_filters', ['project_id' => 'id']);
    }
}