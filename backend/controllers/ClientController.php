<?php

namespace backend\controllers;

use backend\lists\ClientList;
use backend\lists\ContactList;
use backend\lists\StatusList;
use backend\providers\MapDataProvider;
use core\entities\Client;
use core\entities\Contact;
use core\forms\ContactForm;
use core\forms\frontend\ClientForm;
use core\readModels\CacheReadRepository;
use core\readModels\ClientReadRepository;
use core\readModels\ContactReadRepository;
use core\services\ClientService;
use core\services\ContactService;
use yii\rest\Controller;

class ClientController extends Controller
{
    private $clients;
    private $service;

    public function __construct($id, $module, ClientReadRepository $clients, ClientService $service, $config = [])
    {
        $this->clients = $clients;
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function verbs(): array
    {
        return [
            'index' => ['GET'],
            'client' => ['GET'],
            'update' => ['GET', 'PUT', 'PATCH'],
        ];
    }

    public function actionIndex()
    {
        $clients= $this->clients->getAll();
        return new MapDataProvider($clients, [$this, 'serializeListItem']);
    }

    public function actionClient()
    {
        $clients= $this->clients->getAllNew();
        return new MapDataProvider($clients, [$this, 'serializeListItemNew']);
    }

    public function actionUpdate($id)
    {
        $client = $this->clients->find($id);
        $form = new ClientForm($client);
        AppController::actionUpdate($form, $this->service, $client->id);
        return [
            'errors' => $form->errors,
            'status' => StatusList::formListClient(),
        ];
    }

    public function serializeListItem(Client $client)
    {
        return ClientList::serializeListItem($client);
    }

    public function serializeListItemNew(Client $client)
    {
        return ClientList::serializeListItemNew($client);
    }
}
