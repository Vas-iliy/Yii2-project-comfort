<?php

namespace core\services;

use core\entities\Contact;
use core\forms\ContactFrom;
use core\repositories\ContactRepository;

class ContactService
{
    private $contacts;

    public function __construct(ContactRepository $contacts)
    {
        $this->contacts = $contacts;
    }

    public function create(ContactFrom $form)
    {
        $project = Contact::create(
            $form->title,
            $form->content,
            $form->status
        );
        $this->contacts->save($project);
        return $project;
    }

    public function edit($id, ContactFrom $form)
    {
        $project = $this->contacts->get($id);
        $project->edit(
            $form->title,
            $form->content,
            $form->status
        );
        $this->contacts->save($project);
        return $project;
    }

    public function remove($id)
    {
        $project = $this->contacts->get($id);
        $this->contacts->remove($project);
    }
}