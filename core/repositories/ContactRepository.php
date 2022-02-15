<?php

namespace core\repositories;

use core\entities\Contact;
use yii\web\NotFoundHttpException;

class ContactRepository
{
    public function getContacts()
    {
        $contacts = \Yii::$app->cache->get('contact');
        if (empty($contacts)) {
            if (!$contacts = Contact::find()->andWhere(['status' => Contact::STATUS_ACTIVE])->asArray()->all()) throw new NotFoundHttpException('Not found.');
            \Yii::$app->cache->set('contact', $contacts, 3600*24*30*12);
        }
        return $contacts;
    }

    public function remove(Contact $contact)
    {
        $contact->status = $contact::STATUS_DELETED;
        if (!$contact->save()) throw new \RuntimeException('Removing error.');
    }

    public function get($id)
    {
        if (!$contact = Contact::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $contact;
    }

    public function save($contact)
    {
        if (!$return = $contact->save()) throw new \RuntimeException('Saving error.');
        return $return;
    }
}