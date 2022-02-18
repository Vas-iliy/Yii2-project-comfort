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

    public function remove(Question $about)
    {
        $about->status = $about::STATUS_DELETED;
        if (!$about->save()) throw new \RuntimeException('Removing error.');
    }

    public function get($id)
    {
        if (!$about = Question::findOne($id)) throw new NotFoundHttpException('Not found.');
        return $about;
    }

    public function save($about)
    {
        if (!$return = $about->save()) throw new \RuntimeException('Saving error.');
        return $return;
    }
}