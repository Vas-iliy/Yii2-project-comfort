<?php

namespace backend\lists;

use core\entities\Filter;
use core\entities\Material;
use core\entities\Project;
use core\entities\ProjectImage;
use core\forms\ProjectFrom;
use core\helpers\StatusHelper;
use yii\helpers\Url;

class StateList
{
    public static function serializeListItem(Project $project)
    {
        return [
            'id' => $project->id,
            'title' => $project->title,
            'square' => $project->square,
            'count' => $project->count_floors,
            'material' => $project->material->material,
            'text' => $project->description,
            'price' => $project->price,
            'popular' => $project->popular,
            'filter' => $project->filter->filter,
            'status' => StatusHelper::status($project->status, new Project()),
            'images' => array_map(function (ProjectImage $image) {
                return $image->getThumbFileUrl('image', 'catalog_list');
            }, $project->images),
        ];
    }

    public static function formListFilter(Filter $filter)
    {
        return [
            'id' => $filter->id,
            'title' => $filter->filter
        ];
    }

    public static function formListMaterial(Material $material)
    {
        return [
            'id' => $material->id,
            'title' => $material->material
        ];
    }

    public static function formProject(ProjectFrom $form)
    {
        return [
            'title' => $form->title,
            'square' => $form->square,
            'count_floors' => $form->count_floors,
            'material' => $form->material,
            'description' => $form->description,
            'price' => $form->price,
            'popular' => $form->popular,
            'filter' => $form->filter,
            'status' => $form->status,
        ];
    }
}