<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

class Filter extends ActiveRecord
{
    public $class;
    public $div;
    public static function tableName()
    {
        return 'filters';
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/filters/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/filters/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/filters/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/filters/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                ],
            ],
        ];
    }
}