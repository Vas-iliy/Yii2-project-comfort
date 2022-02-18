<?php

namespace core\services;

use core\entities\Project;
use core\entities\ProjectImage;
use core\entities\State;
use core\forms\ProjectFrom;
use core\forms\StateFrom;
use core\forms\StateUpdateFrom;
use core\repositories\ProjectRepository;
use core\repositories\StateRepository;
use yii\web\UploadedFile;

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

    public function edit($id, StateUpdateFrom $form)
    {
        $state = $this->states->getState($id);
        if (UploadedFile::getInstance($form, 'image')) {
            $state->edit(
                $form->title,
                $form->title_recommendation,
                $form->content,
                $form->category,
                $form->status ?? null,
                $form->image
            );
        } else {
            $state->editNoImage(
                $form->title,
                $form->title_recommendation,
                $form->content,
                $form->category,
                $form->status ?? null
            );
        }

        $this->states->save($state);
        return $state;
    }

    public function remove($id)
    {
        $state = $this->states->getState($id);
        $this->states->remove($state);
    }
}