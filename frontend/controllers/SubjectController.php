<?php

namespace frontend\controllers;

use core\forms\frontend\ReviewForm;
use core\services\ReviewService;
use Yii;
use yii\web\Controller;

class SubjectController extends Controller
{
    private $service;

    public function __construct($id, $module,ReviewService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionReview()
    {
        $form = new ReviewForm();
        if ($form->load($this->request->post()) && $form->validate()) {
            try {
                $this->service->create($form);
                Yii::$app->session->setFlash('success', 'Review accepted.');
                return $this->redirect('/about');
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
    }
}