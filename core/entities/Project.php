<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Project extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return 'projects';
    }

    public static function create($title, $square, $count_floors, $description, $price, $popular, $material, $filter, $status)
    {
        $project = new static();
        $project->title = $title;
        $project->square = $square;
        $project->count_floors = $count_floors;
        $project->description = $description;
        $project->price = $price;
        $project->popular = $popular;
        $project->material_id = $material;
        $project->filter_id = $filter;
        $project->status = $status;
        return $project;
    }

    public function edit($title, $square, $count_floors, $description, $price, $popular, $material, $filter, $status)
    {
        $this->title = $title;
        $this->square = $square;
        $this->count_floors = $count_floors;
        $this->description = $description;
        $this->price = $price;
        $this->popular = $popular;
        $this->material_id = $material;
        $this->filter_id = $filter;
        $this->status = $status;
    }

    public function addImage(UploadedFile $file)
    {
        $images = $this->images;
        $images[] = ProjectImage::create($file);
        $this->images = $images;
    }

    public function getImages()
    {
        return $this->hasMany(ProjectImage::class, ['project_id' => 'id']);
    }

    public function getMaterial()
    {
        return $this->hasOne(Material::class, ['id' => 'material_id']);
    }

    public function getFilter()
    {
        return $this->hasOne(Filter::class, ['id' => 'filter_id']);
    }
}