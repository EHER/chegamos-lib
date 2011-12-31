<?php

namespace chegamos\entity\factory;

use chegamos\entity\Place;
use chegamos\entity\Category;
use chegamos\entity\Address;
use chegamos\entity\Point;
use chegamos\entity\PlaceInfo;
use chegamos\util\Inflector;
use chegamos\exception\ChegamosException;

class PlaceFactory
{
    public static function generate($placeJsonObject)
    {
        if (is_object($placeJsonObject)) {
            $place = new Place();

            $place->setId($placeJsonObject->id);
            $place->setName($placeJsonObject->name);
            $place->setAverageRating($placeJsonObject->average_rating);
            $place->setReviewCount($placeJsonObject->review_count);
            $place->setCategory(new Category($placeJsonObject->category));
            $place->setSubcategory(new Category($placeJsonObject->subcategory));
            $place->setAddress(new Address($placeJsonObject->address));
            $place->setPoint(new Point($placeJsonObject->point));
            $place->setMainUrl($placeJsonObject->main_url);
            $place->setOtherUrl($placeJsonObject->other_url);
            $place->setIconUrl($placeJsonObject->icon_url);
            $place->setDescription($placeJsonObject->description);
            $place->setCreated($placeJsonObject->created);
            $place->setPhone($placeJsonObject->phone);
            $place->setPlaceInfo(new PlaceInfo($placeJsonObject->extended));
            $place->setNumVisitors($placeJsonObject->num_visitors);
            $place->setNumPhotos($placeJsonObject->num_photos);

            return $place;
        } else {
            throw new ChegamosException("Parâmetro data não é um objeto.");
        }
    }
}
