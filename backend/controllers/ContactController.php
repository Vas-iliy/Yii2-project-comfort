<?php

namespace backend\controllers;

use backend\lists\ContactList;
use backend\providers\MapDataProvider;
use core\entities\Contact;
use core\forms\ContactFrom;
use core\readModels\ContactReadRepository;
use core\services\ContactService;
use Yii;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class ContactController extends Controller
{
    private $contacts;
    private $service;

    public function __construct($id, $module, ContactReadRepository $contacts, ContactService $service, $config = [])
    {
        $this->contacts = $contacts;
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $projects = $this->contacts->getAll();
        return new MapDataProvider($projects, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new ContactFrom();
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()) {
            try {
                $this->service->create($form);
                Yii::$app->getResponse()->setStatusCode(201);
                return [];
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        if ($form->errors) {
            Yii::$app->getResponse()->setStatusCode(400);
        }
        return [
            'errors' => $form->errors
        ];
    }

    public function actionUpdate($id)
    {
        $contact = $this->findModel($id);
        $form = new ContactFrom($contact);
        if ($form->load(Yii::$app->request->getBodyParams(), '') && $form->validate()) {
            try {
                $this->service->edit($contact->id, $form);
                Yii::$app->getResponse()->setStatusCode(201);
                return [];
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }
        if ($form->errors) {
            Yii::$app->getResponse()->setStatusCode(400);
        }
        return [
            'project' => ContactList::formContact($form),
            'errors' => $form->errors,
        ];
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Contact::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function serializeListItem(Contact $contact)
    {
        return ContactList::serializeListItem($contact);
    }
}
