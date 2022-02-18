<?php

namespace core\services;

use core\entities\ServicePoint;
use core\forms\ServicePointFrom;
use core\repositories\ServicePointRepository;

class ServicePointService
{
    private $points;

    public function __construct(ServicePointRepository $points)
    {
        $this->points = $points;
    }

    public function create(ServicePointFrom $form)
    {
        $point = ServicePoint::create(
            $form->title,
            $form->items,
            $form->description,
            $form->service,
            $form->status ?? null
        );
        $this->points->save($point);
        return $point;
    }

    public function edit($id, ServicePointFrom $form)
    {
        $point = $this->points->get($id);
        $point->edit(
            $form->title,
            $form->items,
            $form->description,
            $form->service,
            $form->status ?? null
        );
        $this->points->save($point);
        return $point;
    }

    public function remove($id)
    {
        $point = $this->points->get($id);
        $this->points->remove($point);
    }

}