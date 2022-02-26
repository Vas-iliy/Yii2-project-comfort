<?php

namespace core\services;

use core\entities\Review;
use core\forms\frontend\ReviewForm;
use core\repositories\frontend\ReviewRepository;

class ReviewService
{
    private $reviews;

    public function __construct()
    {
        $this->reviews = new ReviewRepository();
    }

    public function create(ReviewForm $form)
    {
        if (empty($this->reviews->isActive($form->phone))) {
            $review = Review::review($form->name, $form->phone, $form->email, $form->subject);
            $this->reviews->save($review);
            return $review;
        }
        return false;
    }

}