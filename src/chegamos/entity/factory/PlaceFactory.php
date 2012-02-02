<?php

namespace chegamos\entity\factory;

use chegamos\entity\Place;
use chegamos\entity\Category;
use chegamos\entity\Subcategory;
use chegamos\entity\Address;
use chegamos\entity\Point;
use chegamos\entity\PlaceInfo;
use chegamos\entity\factory\PhotoListFactory;
use chegamos\entity\factory\ReviewListFactory;
use chegamos\entity\factory\CategoryFactory;
use chegamos\util\Inflector;
use chegamos\exception\ChegamosException;

class PlaceFactory
{
    public static function generate($placeJsonObject)
    {
        if (is_object($placeJsonObject)) {
            $isFullPlace = isset($placeJsonObject->description);
            $isPhotoList = isset($placeJsonObject->photos);
            $isReviewList = isset($placeJsonObject->reviews);
            $isExtendedPlace = isset($placeJsonObject->extended);
            $isPlaceList = isset($placeJsonObject->name);

            $place = new Place();
            $place->setId($placeJsonObject->id);

            if ($isPlaceList) {
                $place->setName($placeJsonObject->name);
                $place->setAverageRating($placeJsonObject->average_rating);
                $place->setReviewCount($placeJsonObject->review_count);
                $place->setAddress(new Address($placeJsonObject->address));
                $place->setPoint(new Point($placeJsonObject->point));
                $place->setMainUrl($placeJsonObject->main_url);
                $place->setOtherUrl($placeJsonObject->other_url);
                $place->setIconUrl($placeJsonObject->icon_url);
                $place->setCategory(
                    CategoryFactory::generate($placeJsonObject->category)
                );
            }

            if ($isFullPlace) {
                $place->setName($placeJsonObject->name);
                $place->setAverageRating($placeJsonObject->average_rating);
                $place->setReviewCount($placeJsonObject->review_count);
                $place->setAddress(new Address($placeJsonObject->address));
                $place->setPoint(new Point($placeJsonObject->point));
                $place->setMainUrl($placeJsonObject->main_url);
                $place->setOtherUrl($placeJsonObject->other_url);
                $place->setIconUrl($placeJsonObject->icon_url);
                $place->setCategory(
                    CategoryFactory::generate($placeJsonObject->category)
                );
                $place->setDescription($placeJsonObject->description);
                $place->setCreated($placeJsonObject->created);
                $place->setPhone($placeJsonObject->phone);
            }

            if ($isPhotoList) {
                $place->setPhotos(PhotoListFactory::generate($placeJsonObject));
            }

            if ($isReviewList) {
                $place->setReviews(ReviewListFactory::generate($placeJsonObject));
            }

            if ($isExtendedPlace) {
                $place->setPlaceInfo(new PlaceInfo($placeJsonObject->extended));
            }

            return $place;
        } else {
            throw new ChegamosException("Parâmetro data não é um objeto.");
        }
    }
}
