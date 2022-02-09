<?php

namespace core\entities;

use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

class ContactImage extends ActiveRecord
{
    public static function tableName()
    {
        return 'contact_images';
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/contacts/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/contacts/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/contacts/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/contacts/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                ],
            ],
        ];
    }
}