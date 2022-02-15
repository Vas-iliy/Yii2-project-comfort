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

    public function create(ContactFrom $from)
    {
        $project = Contact::create(
            $from->title,
            $from->content
        );
        $this->contacts->saveContact($project);
        return $project;
    }

    public function edit($id, ContactFrom $from)
    {
        $project = $this->contacts->getContact($id);
        $project->edit(
            $from->title,
            $from->content
        );
        $this->contacts->saveContact($project);
        return $project;
    }
}