<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

class ProjectImage extends ActiveRecord
{
    public static function tableName()
    {
        return 'project_images';
    }

    public static function create(UploadedFile $file, $id)
    {
        $image = new static();
        $image->image = $file;
        $image->project_id = $id;
        return $image;
    }

    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/projects/[[attribute_project_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/projects/[[attribute_project_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/projects/[[attribute_project_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/projects/[[attribute_project_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'catalog_list' => ['width' => 228, 'height' => 228],
                ],
            ],
        ];
    }
}