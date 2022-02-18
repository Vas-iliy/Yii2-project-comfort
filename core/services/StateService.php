<?php

namespace core\services;

use core\entities\Project;
use core\entities\ProjectImage;
use core\entities\State;
use core\forms\ProjectFrom;
use core\forms\StateFrom;
use core\repositories\ProjectRepository;
use core\repositories\StateRepository;

class StateService
{
    private $states;

    public function __construct(StateRepository $states)
    {
        $this->states = $states;
    }

    public function create(StateFrom $form)
    {
        $state = State::create(
            $form->title,
            $form->title_recommendation,
            $form->content,
            $form->category,
            $form->status ?? null,
            $form->image
        );
        $this->states->save($state);

        return $state;
    }

    public function edit($id, StateFrom $form)
    {
        $state = $this->states->getState($id);
        $state->edit(
            $form->title,
            $form->title_recommendation,
            $form->content,
            $form->category,
            $form->status ?? null,
            $form->image
        );
        $this->states->save($state);
        return $state;
    }

    public function remove($id)
    {
        $state = $this->states->getState($id);
        $this->states->remove($state);
    }

    public function deleteImage(State $state)
    {
        if ($state) {
            $arr = explode('.', $state->image);
            $extension = $arr[count($arr)-1];
            if (unlink(\Yii::getAlias("@staticRoot/origin/states/{$state->id}") . '.' . $extension)) {
                $this->states->removeImage($state);
                return true;
            }
        }
        return false;
    }
}