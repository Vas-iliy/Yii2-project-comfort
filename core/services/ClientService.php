<?php

namespace core\services;

use core\entities\Client;
use core\forms\frontend\ClientForm;
use core\repositories\frontend\ClientRepository;
use Yii;

class ClientService
{
    private $clients;

    public function __construct()
    {
        $this->clients = new ClientRepository();
    }

    public function create(ClientForm $form)
    {
        if (empty($this->clients->isActive($form->phone))) {
            $client = Client::client($form->name, $form->phone, $form->material);
            $this->clients->save($client);
            /*$sent = \Yii::$app->mailer
                ->compose(
                    ['html' => 'client-html', 'text' => 'client-text'],
                    ['model' => $form]
                )
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject('Потенциальный клиент: ' . $form->name)
                ->send();
            if (!$sent) throw new \RuntimeException('Sending error.');*/
            return $client;
        }
        return false;
    }

    public function edit($id, ClientForm $form)
    {
        $contact = $this->clients->get($id);
        $contact->edit(
            $form->status ?? null
        );
        $this->clients->save($contact);
        return $contact;
    }
}