<?php

namespace backend\lists;

use core\entities\Question;
use core\forms\QuestionForm;
use core\helpers\StatusHelper;

class QuestionList
{
    public static function serializeListItem(Question $question)
    {
        return [
            'id' => $question->id,
            'title' => $question->title,
            'description' => $question->description,
            'status' => StatusHelper::status($question->status, new Question())
        ];
    }

    public static function formQuestion(QuestionForm $form)
    {
        return [
            'title' => $form->title,
            'description' => $form->description,
            'status' => $form->status
        ];
    }
}