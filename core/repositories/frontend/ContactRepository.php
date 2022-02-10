<?php

namespace core\repositories\frontend;

use core\entities\Contact;
use yii\web\NotFoundHttpException;

class ContactRepository
{
    public function getContacts()
    {
        $contacts = \Yii::$app->cache->get('contact');
        if (empty($contacts)) {
            $contacts = Contact::find()->asArray()->all();
            \Yii::$app->cache->set('contact', $contacts, 3600*24*30*12);
        }
        return $contacts;
    }
}