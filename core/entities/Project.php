<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Project extends ActiveRecord
{
    public static function tableName()
    {
        return 'projects';
    }

    public static function create($title, $square, $count_floors, $description, $price, $popular, $material, $filter)
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
        return $project;
    }

    public function edit($title, $square, $count_floors, $description, $price, $popular, $material, $filter)
    {
        $this->title = $title;
        $this->square = $square;
        $this->count_floors = $count_floors;
        $this->description = $description;
        $this->price = $price;
        $this->popular = $popular;
        $this->material_id = $material;
        $this->filter_id = $filter;
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