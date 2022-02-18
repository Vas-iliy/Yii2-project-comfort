<?php

namespace core\services;

use core\entities\Question;
use core\forms\QuestionFrom;
use core\repositories\QuestionRepository;

class QuestionService
{
    private $questions;

    public function __construct(QuestionRepository $questions)
    {
        $this->questions = $questions;
    }

    public function create(QuestionFrom $form)
    {
        $question = Question::create(
            $form->title,
            $form->description,
            $form->status ?? null
        );
        $this->questions->save($question);
        return $question;
    }

    public function edit($id, QuestionFrom $form)
    {
        $question = $this->questions->get($id);
        $question->edit(
            $form->title,
            $form->description,
            $form->status ?? null
        );
        $this->questions->save($question);
        return $question;
    }

    public function remove($id)
    {
        $question = $this->questions->get($id);
        $this->questions->remove($question);
    }
}