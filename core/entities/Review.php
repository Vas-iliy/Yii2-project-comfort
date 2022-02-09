<?php

namespace core\entities;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Review extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function tableName()
    {
        return 'reviews';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    public static function review($name, $phone, $email, $subject)
    {
        $review = new static();
        $review->name = $name;
        $review->phone = $phone;
        $review->email = $email;
        $review->subject = $subject;
        return $review;
    }
}