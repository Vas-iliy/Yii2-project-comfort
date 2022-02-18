<?php

namespace core\services;

use core\entities\ServicePoint;
use core\forms\ServicePointForm;
use core\repositories\ServicePointRepository;

class ServicePointService
{
    private $points;

    public function __construct(ServicePointRepository $points)
    {
        $this->points = $points;
    }

    public function create(ServicePointForm $form)
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

    public function edit($id, ServicePointForm $form)
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