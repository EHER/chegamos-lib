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
use chegamos\entity\container\UtilityList;
use chegamos\entity\Utility;

class PlaceFactory
{
    private static $placeJsonObject;

    public static function generate($placeJsonObject)
    {
        if (is_object($placeJsonObject)) {
            return self::createAndPopulatePlace($placeJsonObject);
        }

        throw new ChegamosException("Parâmetro data não é um objeto.");
    }

    private static function createAndPopulatePlace($placeJsonObject)
    {
        self::$placeJsonObject = $placeJsonObject;

        $place = new Place();
        $place->setId(self::$placeJsonObject->id);

        self::populateUtilities($place);

        self::populatePlaceWhenIsAPlaceList($place);
        self::populatePlaceWhenIsAPlaceListOrFullPlace($place);
        self::populatePlaceWhenIsAFullPlace($place);
        self::populatePlaceWhenIsAPhotoList($place);
        self::populatePlaceWhenIsAReviewList($place);
        self::populatePlaceWhenIsExtendedPlace($place);

        return $place;
    }

    private static function populateUtilities(Place $place)
    {
        if (empty(self::$placeJsonObject->utilities)) {
            return;
        }

        $utilities = new UtilityList();
        foreach (self::$placeJsonObject->utilities as $item) {
            $utility = new Utility();

            // php as vezes chateia-nos... :/
            $type = isset($item->type) ? $item->type: '';
            $partnerToken = isset($item->partnerToken) ? $item->partnerToken : '';
            $endPointUrl = isset($item->endpoint_url) ? $item->endpoint_url : '';

            $utility->setType($type)
                ->setPartnerToken($partnerToken)
                ->setEndPointUrl($endPointUrl);

            $utilities->add($utility);
        }

        $place->setUtilities($utilities);
    }

    private static function populatePlaceWhenIsAPlaceList($place)
    {
        if (self::isPlaceList()) {
            $place->setSmallPhotoUrl(self::$placeJsonObject->small_photo_url);
        }
    }

    private static function isPlaceList()
    {
        return isset(self::$placeJsonObject->small_photo_url);
    }

    private static function populatePlaceWhenIsAPlaceListOrFullPlace($place)
    {
        if (self::isPlaceListOrFullPlace()) {
            $place->setName(self::$placeJsonObject->name);
            $place->setAverageRating(self::$placeJsonObject->average_rating);
            $place->setReviewCount(self::$placeJsonObject->review_count);
            $place->setAddress(new Address(self::$placeJsonObject->address));
            $place->setPoint(PointFactory::generate(self::$placeJsonObject->point));
            $place->setMainUrl(self::$placeJsonObject->main_url);
            $place->setOtherUrl(self::$placeJsonObject->other_url);
            $place->setIconUrl(self::$placeJsonObject->icon_url);

            $place->setCategory(
                CategoryFactory::generate(self::$placeJsonObject->category)
            );
            $place->setPhone(PhoneFactory::generate(self::$placeJsonObject->phone));
        }
    }

    private static function isPlaceListOrfullPlace()
    {
        return isset(self::$placeJsonObject->name);
    }

    private static function populatePlaceWhenIsAFullPlace($place)
    {
        if (self::isFullPlace()) {
            $place->setDescription(self::$placeJsonObject->description);
            $place->setCreated(self::$placeJsonObject->created);
        }
    }

    private static function isFullPlace()
    {
        return isset(self::$placeJsonObject->description);
    }

    private static function populatePlaceWhenIsAPhotoList($place)
    {
        if (self::isPhotoList()) {
            $place->setPhotos(PhotoListFactory::generate(self::$placeJsonObject));
        }
    }

    private static function isPhotoList()
    {
        return isset(self::$placeJsonObject->photos);
    }

    private static function populatePlaceWhenIsAReviewList($place)
    {
        if (self::isReviewList()) {
            $place->setReviews(ReviewListFactory::generate(self::$placeJsonObject));
        }
    }

    private static function isReviewList()
    {
        return isset(self::$placeJsonObject->reviews);
    }

    private static function populatePlaceWhenIsExtendedPlace($place)
    {
        if (self::isExtendedPlace()) {
            $place->setPlaceInfo(new PlaceInfo(self::$placeJsonObject->extended));
        }
    }

    private static function isExtendedPlace()
    {
        return isset(self::$placeJsonObject->extended);
    }
}
