<?php

namespace frontend\controllers;

use core\forms\frontend\ClientForm;
use core\forms\frontend\ReviewForm;
use core\services\ClientService;
use core\services\ReviewService;
use Yii;
use yii\web\Controller;

class SubjectController extends Controller
{
    private $service;
    private $client;

    public function __construct($id, $module,ReviewService $service, ClientService $client, $config = [])
    {
        $this->service = $service;
        $this->client = $client;
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

    public function actionClient()
    {
        $form = new ClientForm();
        if ($form->load($this->request->post()) && $form->validate()) {
            try {
                if ($this->client->create($form)) {
                    Yii::$app->session->setFlash('success', 'client');
                }
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
    }
}