<?php

namespace backend\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class AppController extends Controller
{
    public static function actionCreate($form, $service)
    {
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()) {
            try {
                $service->create($form);
                Yii::$app->getResponse()->setStatusCode(201);
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        if ($form->errors) {
            Yii::$app->getResponse()->setStatusCode(400);
        }
    }

    public static function actionUpdate($form, $service, $id)
    {
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()) {
            try {
                $service->edit($id, $form);
                Yii::$app->getResponse()->setStatusCode(201);
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        if ($form->errors) {
            Yii::$app->getResponse()->setStatusCode(400);
        }
    }

    public static function actionDelete($id, $service)
    {
        try {
            $service->remove($id);
            Yii::$app->getResponse()->setStatusCode(202);
        }  catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }
}