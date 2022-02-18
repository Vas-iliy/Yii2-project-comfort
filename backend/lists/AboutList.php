<?php

namespace backend\lists;

use core\entities\Contact;
use core\forms\ContactFrom;
use core\helpers\StatusHelper;

class AboutList
{
    public static function serializeListItem(Contact $contact)
    {
        return [
            'id' => $contact->id,
            'title' => $contact->title,
            'content' => $contact->content,
            'status' => StatusHelper::status($contact->status, new Contact())
        ];
    }

    public static function formContact(ContactFrom $form)
    {
        return [
            'title' => $form->title,
            'content' => $form->content,
            'status' => $form->status
        ];
    }
}