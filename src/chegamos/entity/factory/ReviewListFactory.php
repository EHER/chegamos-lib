<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\container\ReviewList;

class ReviewListFactory
{
    public static function generate($reviewListJsonObject)
    {
        if (is_object($reviewListJsonObject)) {
            $reviewList = new ReviewList();
            $reviewList->setNumFound($reviewListJsonObject->result_count);
            $reviewList->setCurrentPage($reviewListJsonObject->current_page);
            foreach ($reviewListJsonObject->reviews as $review) {
                $reviewList->add(ReviewFactory::generate($review->review));
            }
            return $reviewList;
        } else {
            throw new ChegamosException("Parâmetro passado não é um objeto.");
        }
    }
}
