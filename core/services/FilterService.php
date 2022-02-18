<?php

namespace core\services;

use core\entities\Filter;
use core\forms\FilterForm;
use core\repositories\FilterRepository;

class FilterService
{
    private $filters;

    public function __construct(FilterRepository $filters)
    {
        $this->filters = $filters;
    }

    public function create(FilterForm $form)
    {
        $filter = Filter::create(
            $form->filter,
            $form->status ?? null,
            $form->top,
            $form->image
        );
        $this->filters->save($filter);

        return $filter;
    }

    public function edit($id, FilterForm $form)
    {
        $filter = $this->filters->get($id);
        $filter->edit(
            $form->filter,
            $form->status ?? null,
            $form->top,
            $form->image
        );

        $this->filters->save($filter);
        return $filter;
    }

    public function remove($id)
    {
        $filter = $this->filters->get($id);
        $this->filters->remove($filter);
    }
}