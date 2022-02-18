<?php

namespace backend\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class AppController extends Controller
{
    public static function actionCreate($form, $service, $cache)
    {
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()) {
            try {
                if ($service->create($form)) {
                    Yii::$app->getResponse()->setStatusCode(201);
                    foreach ($cache as $value) {
                        Yii::$app->cache->delete($value);
                    }
                }
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        if ($form->errors) {
            Yii::$app->getResponse()->setStatusCode(400);
        }
    }

    public static function actionUpdate($form, $service, $id, $cache = null)
    {
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()) {
            try {
                if ($service->edit($id, $form)) {
                    Yii::$app->getResponse()->setStatusCode(201);
                    if ($cache) {
                        foreach ($cache as $value) {
                            Yii::$app->cache->delete($value);
                        }
                    }
                }
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        if ($form->errors) {
            Yii::$app->getResponse()->setStatusCode(400);
        }
    }

    public static function actionDelete($id, $service, $cache)
    {
        try {
            $service->remove($id);
            Yii::$app->getResponse()->setStatusCode(202);
            foreach ($cache as $value) {
                Yii::$app->cache->delete($value);
            }
        }  catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }
}