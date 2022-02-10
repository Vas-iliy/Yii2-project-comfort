<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

class WorkImage extends ActiveRecord
{
    public static function tableName()
    {
        return 'works_images';
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/works/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/works/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/works/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/works/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                ],
            ],
        ];
    }

}