<?php

namespace chegamos\entity\factory;

use chegamos\entity\Place;
use chegamos\entity\Category;
use chegamos\entity\Subcategory;
use chegamos\entity\Address;
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
            $isPlaceListOrFullPlace = isset($placeJsonObject->name);
            $isPlaceList = isset($placeJsonObject->small_photo_url);

            $place = new Place();
            $place->setId($placeJsonObject->id);

            if ($isPlaceList) {
            	$place->setSmallPhotoUrl($placeJsonObject->small_photo_url);
            }
            
            if ($isPlaceListOrFullPlace) {
                $place->setName($placeJsonObject->name);
                $place->setAverageRating($placeJsonObject->average_rating);
                $place->setReviewCount($placeJsonObject->review_count);
                $place->setAddress(new Address($placeJsonObject->address));
                $place->setPoint(PointFactory::generate($placeJsonObject->point));
                $place->setMainUrl($placeJsonObject->main_url);
                $place->setOtherUrl($placeJsonObject->other_url);
                $place->setIconUrl($placeJsonObject->icon_url);
                $place->setCategory(
                    CategoryFactory::generate($placeJsonObject->category)
                );
                $place->setPhone(PhoneFactory::generate($placeJsonObject->phone));
            }
            
            if ($isFullPlace) {
                $place->setDescription($placeJsonObject->description);
                $place->setCreated($placeJsonObject->created);
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
