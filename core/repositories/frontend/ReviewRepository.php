<?php

namespace core\repositories\frontend;

use core\entities\Review;

class ReviewRepository
{
    public function save(Review $review)
    {
        if (!$review->save()) throw new \RuntimeException('Saving error.');
    }
}