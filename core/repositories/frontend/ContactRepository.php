<?php

namespace core\repositories\frontend;

use core\entities\Contact;
use yii\web\NotFoundHttpException;

class ContactRepository
{
    public function getContacts()
    {
        if (!$contacts = Contact::find()->asArray()->all()) {
            throw new NotFoundHttpException('No contacts.');
        }
        return $contacts;
    }
}