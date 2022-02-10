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

    protected function get($id, $class)
    {
        if (!$data = $class->findOne($id)) throw new NotFoundHttpException('Not found.');
        return $data;
    }
}