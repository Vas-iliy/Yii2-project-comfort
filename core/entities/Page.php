<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

class Page extends ActiveRecord
{
    public static function tableName()
    {
        return 'pages';
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/pages/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/pages/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/pages/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/pages/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                ],
            ],
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'icon',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/pages/icons/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/pages/icons/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/pages/icons/[[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/pages/icons/[[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                ],
            ],
        ];
    }
}