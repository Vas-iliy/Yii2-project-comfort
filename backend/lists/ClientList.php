<?php

namespace backend\lists;

use core\entities\Client;
use core\helpers\StatusHelper;

class ClientList
{
    public static function serializeListItem(Client $client)
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'phone' => $client->phone,
            'material' => $client->material,
            'created' => $client->created_at,
            'updated' => $client->updated_at,
            'status' => StatusHelper::client($client->status, new Client())
        ];
    }

    public static function serializeListItemNew(Client $client)
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'phone' => $client->phone,
            'material' => $client->material,
            'time' => $client->created_at,
            'status' => StatusHelper::client($client->status, new Client())
        ];
    }
}