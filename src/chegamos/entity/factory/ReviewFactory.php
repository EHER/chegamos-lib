<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\Review;

class ReviewFactory
{
    public static function generate($reviewJsonObject)
    {
        if (is_object($reviewJsonObject)) {
            $review = new Review();

            $review->setId($reviewJsonObject->id);
            $review->setRating($reviewJsonObject->rating);
            $review->setContent($reviewJsonObject->content);
            $review->setCreated(
                new \DateTime($reviewJsonObject->created->timestamp)
            );
            $review->setAuthor(
                UserFactory::generate($reviewJsonObject->created->user)
            );

            return $review;
        } else {
            throw new ChegamosException("Parâmetro passado não é um objeto.");
        }
    }
}
