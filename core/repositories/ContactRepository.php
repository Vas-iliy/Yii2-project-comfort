<?php

namespace core\repositories;

use core\entities\Contact;

class ContactRepository extends Repository
{
    public function getContacts()
    {
        $contacts = \Yii::$app->cache->get('contact');
        if (empty($contacts)) {
            $contacts = $this->getAllArray(new Contact());
            \Yii::$app->cache->set('contact', $contacts, 3600*24*30*12);
        }
        return $contacts;
    }

    public function getContact($id)
    {
        return $this->get($id, new Contact());
    }

    public function saveContact($contact)
    {
        return $this->save($contact);
    }
}