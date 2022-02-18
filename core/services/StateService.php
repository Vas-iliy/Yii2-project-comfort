<?php

namespace core\services;

use core\entities\Project;
use core\entities\ProjectImage;
use core\entities\State;
use core\forms\ProjectForm;
use core\forms\StateForm;
use core\forms\StateUpdateForm;
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

    public function create(StateForm $form)
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

    public function edit($id, StateUpdateForm $form)
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