<?php

namespace chegamos\entity\factory;

use \stdClass;
use chegamos\entity\Place;
use chegamos\entity\Point;
use chegamos\entity\Category;
use chegamos\entity\Address;
use chegamos\entity\PlaceInfo;
use chegamos\exception\ChegamosException;
use chegamos\entity\container\UtilityList;
use chegamos\entity\Utility;

class PlaceFactory
{
    public static function fromJson($json)
    {
        $jsonObject = json_decode($json);

        if (!is_object($jsonObject)) {
            throw new ChegamosException("Parâmetro data não é um objeto.");
        }

        return self::fromStdClass($jsonObject);
    }

    public static function fromStdClass(stdClass $jsonObject)
    {
        if (isset($jsonObject->place)) {
            $jsonObject = $jsonObject->place;
        }

        $place = new Place();

        $place->setId($jsonObject->id);
        $place->setName($jsonObject->name);
        $place->setAverageRating($jsonObject->statistics->rating);
        $place->setReviewCount($jsonObject->statistics->reviews);

        $place->setCategory(CategoryFactory::fromStdClass(
            $jsonObject->categories[0]
        ));

        $place->setAddress(AddressFactory::fromStdClass(
            $jsonObject->address
        ));

        $place->setPoint(new Point(
            $jsonObject->location->lat,
            $jsonObject->location->lng
        ));

        $place->setMainUrl($jsonObject->urlApontador);
        $place->setOtherUrl('#other-url');

        if (isset($jsonObject->phones[0])) {
            $place->setPhone(PhoneFactory::fromString($jsonObject->phones[0]));
        }

        return $place;
    }
}
