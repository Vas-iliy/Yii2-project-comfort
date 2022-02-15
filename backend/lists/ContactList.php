<?php

namespace backend\lists;

use core\entities\Contact;
use core\forms\ContactFrom;

class ContactList
{
    public static function serializeListItem(Contact $contact)
    {
        return [
            'id' => $contact->id,
            'title' => $contact->title,
            'content' => $contact->content,
        ];
    }

    public static function formContact(ContactFrom $form)
    {
        return [
            'title' => $form->title,
            'content' => $form->content,
        ];
    }
}