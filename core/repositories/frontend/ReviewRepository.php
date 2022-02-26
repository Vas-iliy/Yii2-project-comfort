<?php

namespace core\repositories\frontend;

use core\entities\Review;

class ReviewRepository
{
    public function save(Review $review)
    {
        if (!$review->save()) throw new \RuntimeException('Saving error.');
    }

    public function isActive($phone)
    {
        return Review::find()->select('id')->andWhere(['phone' => $phone, 'status' => Review::STATUS_INACTIVE])->limit(1)->one();
    }
}