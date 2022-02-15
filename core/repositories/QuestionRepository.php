<?php

namespace core\repositories;

use core\entities\Question;
use core\helpers\TitleHelper;
use yii\web\NotFoundHttpException;

class QuestionRepository
{
    public function getAll()
    {
        $questions = \Yii::$app->cache->get('questions');
        if (empty($questions)) {
            if (!$questions = Question::find()->andWhere(['status' => Question::STATUS_ACTIVE])->all()) throw new NotFoundHttpException('Not found.');
            $questions = TitleHelper::editTitle($questions);
            \Yii::$app->cache->set('questions', $questions, 3600*24*30*12);
        }
        return $questions;
    }
}