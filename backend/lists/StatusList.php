<?php


namespace backend\lists;


class StatusList
{
    public static function formListStatus()
    {
        return [
            [
                'id' => 0,
                'status' => 'Deleted'
            ],
            [
                'id' => 9,
                'status' => 'No active'
            ],
            [
                'id' => 10,
                'status' => 'Active'
            ]
        ];
    }
}