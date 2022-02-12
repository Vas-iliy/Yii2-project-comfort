<?php

namespace backend\controllers\auth;

use core\forms\auth\ResendVerificationEmailForm;
use core\services\auth\ResendVerificationEmailService;
use core\services\auth\VerifyEmailService;
use Yii;
use yii\base\InvalidArgumentException;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class VerificationController extends Controller
{
    private $verify;
    private $resend;

    public function __construct($id, $module, VerifyEmailService $verify, ResendVerificationEmailService $resend, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->verify = $verify;
        $this->resend = $resend;
    }

    public function actionIndex($token)
    {
        try {
            if (($user = $this->verify->verifyEmail($token)) && Yii::$app->user->login($user)) {
                ///return token
            }
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        return $this->goHome();
    }

    public function actionResendEmail()
    {
        $form = new ResendVerificationEmailForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->resend->sendEmail($form);
                return $this->goHome();
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage());
            }
        }

        return $form;
    }
}