<?php


namespace core\repositories\frontend;


use yii\web\NotFoundHttpException;

class Repository
{
    protected function getAll($class)
    {
        if (!$data = $class->find()->all()) throw new NotFoundHttpException('Not found.');
        return $data;
    }

    protected function save($class)
    {
        if (!$class->save()) throw new \RuntimeException('Saving error.');
        return $class;
    }

    protected function get($id, $class)
    {
        if (!$data = $class->findOne($id)) throw new NotFoundHttpException('Not found.');
        return $data;
    }

    public function getBy($class, $condition)
    {
        if (!$data = $class->find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundHttpException('Not found');
        }
        return $data;
    }

    protected function getAllArray($class)
    {
        if (!$data = $class->find()->asArray()->all()) throw new NotFoundHttpException('Not found.');
        return $data;
    }
}