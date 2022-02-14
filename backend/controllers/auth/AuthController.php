<?php

namespace backend\controllers\auth;

use core\forms\auth\LoginForm;
use core\forms\auth\SignupForm;
use core\services\auth\AuthService;
use Yii;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class AuthController extends Controller
{
    private $service;

    public function __construct($id, $module, AuthService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }
    public function actionSignup()
    {
        $form = new SignupForm();;
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()) {
            try {
                $this->service->signup($form);
                Yii::$app->getResponse()->setStatusCode(204);
                Yii::$app->getResponse()->getHeaders()->set('Location', Url::to(['site/index'], true));
            } catch(\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        return $form;
    }

    public function actionLogin()
    {
        $form = new LoginForm();
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()){
            try {
                if ($token = $this->service->auth($form)) {
                    return $this->redirect(['oauth2/rest/token', 'username' => $form->username, 'password' => $form->password]);
                }
            } catch(\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        return $form;
    }

    public function actionRefreshToken()
    {

    }
}