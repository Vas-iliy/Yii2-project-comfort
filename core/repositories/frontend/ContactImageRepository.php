<?php

namespace core\repositories\frontend;

use core\entities\ContactImage;
use yii\web\NotFoundHttpException;

class ContactImageRepository
{
    public function getContacts()
    {
        if (!$images = ContactImage::find()->limit(2)->all()) {
            throw new NotFoundHttpException('No contacts.');
        }
        return $images;
    }

}