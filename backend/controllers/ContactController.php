<?php

namespace backend\controllers;

use backend\lists\ContactList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\Contact;
use core\forms\ContactFrom;
use core\readModels\CacheReadRepository;
use core\readModels\ContactReadRepository;
use core\services\ContactService;
use yii\rest\Controller;
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
        $contacts= $this->contacts->getAll();
        return new MapDataProvider($contacts, [$this, 'serializeListItem']);
    }

    public function actionCreate()
    {
        $form = new ContactFrom();
        AppController::actionCreate($form, $this->service, CacheReadRepository::cacheContact());
        return [
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionUpdate($id)
    {
        $contact = $this->findModel($id);
        $form = new ContactFrom($contact);
        AppController::actionUpdate($form, $this->service, $contact->id, CacheReadRepository::cacheContact());
        return [
            'contact' => ContactList::formContact($form),
            'errors' => $form->errors,
            'status' => StatusList::formListStatus(),
        ];
    }

    public function actionDelete($id)
    {
        AppController::actionDelete($id, $this->service, CacheReadRepository::cacheContact());
        return [];
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
