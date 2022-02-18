<?php

namespace core\readModels;

use core\entities\Question;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class QuestionReadRepository
{
    public function getAll()
    {
        $query = Question::find();
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return Question::findOne($id);
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}