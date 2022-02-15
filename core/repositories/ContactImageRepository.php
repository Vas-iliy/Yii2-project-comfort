<?php

namespace core\repositories;

use core\entities\ContactImage;

class ContactImageRepository
{
    public function getContacts()
    {
        $images = \Yii::$app->cache->get('images_about');
        if (empty($images)) {
            $images = ContactImage::find()->limit(2)->all();
            \Yii::$app->cache->set('images_about', $images, 3600*24*30);
        }
        return $images;
    }

}