<?php


namespace core\helpers;


class StatusHelper
{
    public static function status($status, $class)
    {
        switch ($status) {
            case $class::STATUS_INACTIVE:
                $string = 'No active';
                break;
            case $class::STATUS_DELETED:
                $string = 'Deleted';
                break;
            case $class::STATUS_ACTIVE:
                $string = 'Active';
                break;
        }

        return [
            'id' => $status,
            'status' => $string
        ];
    }

    public static function client($status, $class)
    {
        switch ($status) {
            case $class::STATUS_NEW:
                $string = 'New';
                break;
            case $class::STATUS_ADMIN:
                $string = 'Admin';
                break;
        }

        return [
            'id' => $status,
            'status' => $string
        ];
    }
}