<?php

namespace core\services;

use core\entities\Advantage;
use core\forms\AdvantageFrom;
use core\repositories\AdvantageRepository;

class AdvantageService
{
    private $advantages;

    public function __construct(AdvantageRepository $advantages)
    {
        $this->advantages = $advantages;
    }

    public function create(AdvantageFrom $form)
    {
        $advantage = Advantage::create(
            $form->title,
            $form->description,
            $form->status ?? null
        );
        $this->advantages->save($advantage);
        return $advantage;
    }

    public function edit($id, AdvantageFrom $form)
    {
        $advantage = $this->advantages->get($id);
        $advantage->edit(
            $form->title,
            $form->description,
            $form->status ?? null
        );
        $this->advantages->save($advantage);
        return $advantage;
    }

    public function remove($id)
    {
        $advantage = $this->advantages->get($id);
        $this->advantages->remove($advantage);
    }
}