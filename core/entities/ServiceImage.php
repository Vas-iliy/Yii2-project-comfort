<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

class ServiceImage extends ActiveRecord
{
    public static function tableName()
    {
        return 'service_images';
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/services/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/services/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/services/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/services/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                ],
            ],
        ];
    }
}