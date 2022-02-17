<?php

namespace core\readModels;

use core\entities\Contact;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class ContactReadRepository
{
    public function getAll()
    {
        $query = Contact::find();
        return $this->getProvider($query);
    }

    public function find($id)
    {
        return Contact::findOne($id);
    }

    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}