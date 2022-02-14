<?php


namespace core\repositories;


use core\entities\Question;
use core\helpers\TitleHelper;
use core\repositories\Repository;

class QuestionRepository extends Repository
{
    public function getQuestions()
    {
        $questions = \Yii::$app->cache->get('questions');
        if (empty($questions)) {
            $questions = $this->getAll(new Question());
            $questions = TitleHelper::editTitle($questions);
            \Yii::$app->cache->set('questions', $questions, 3600*24*30*12);
        }
        return $questions;
    }
}