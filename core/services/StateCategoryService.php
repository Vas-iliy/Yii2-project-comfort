<?php

namespace core\services;

use core\entities\Contact;
use core\forms\ContactFrom;
use core\repositories\ContactRepository;

class StateCategoryService
{
    private $categories;

    public function __construct(ContactRepository $categories)
    {
        $this->contacts = $categories;
    }

    public function create(ContactFrom $form)
    {
        $category = Contact::create(
            $form->title,
            $form->content,
            $form->status ?? null
        );
        $this->contacts->save($category);
        return $category;
    }

    public function edit($id, ContactFrom $form)
    {
        $category = $this->contacts->get($id);
        $category->edit(
            $form->title,
            $form->content,
            $form->status ?? null
        );
        $this->contacts->save($category);
        return $category;
    }

    public function remove($id)
    {
        $category = $this->contacts->get($id);
        $this->contacts->remove($category);
    }
}