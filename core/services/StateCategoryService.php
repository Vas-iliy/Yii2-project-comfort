<?php

namespace core\services;

use core\entities\StateCategory;
use core\forms\StateCategoryFrom;
use core\repositories\StateCategoryRepository;

class StateCategoryService
{
    private $categories;

    public function __construct(StateCategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function create(StateCategoryFrom $form)
    {
        $category = StateCategory::create(
            $form->title,
            $form->status ?? null
        );
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, StateCategoryFrom $form)
    {
        $category = $this->categories->get($id);
        $category->edit(
            $form->title,
            $form->status ?? null
        );
        $this->categories->save($category);
        return $category;
    }

    public function remove($id)
    {
        $category = $this->categories->get($id);
        $this->categories->remove($category);
    }
}