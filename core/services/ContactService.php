<?php

namespace core\services;

use core\entities\Contact;
use core\forms\ContactForm;
use core\repositories\ContactRepository;

class ContactService
{
    private $contacts;

    public function __construct(ContactRepository $contacts)
    {
        $this->contacts = $contacts;
    }

    public function create(ContactForm $form)
    {
        $contact = Contact::create(
            $form->title,
            $form->content,
            $form->status ?? null
        );
        $this->contacts->save($contact);
        return $contact;
    }

    public function edit($id, ContactForm $form)
    {
        $contact = $this->contacts->get($id);
        $contact->edit(
            $form->title,
            $form->content,
            $form->status ?? null
        );
        $this->contacts->save($contact);
        return $contact;
    }

    public function remove($id)
    {
        $contact = $this->contacts->get($id);
        $this->contacts->remove($contact);
    }
}