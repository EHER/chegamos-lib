<?php

namespace chegamos\entity\factory;

use \stdClass;
use chegamos\entity\Address;
use chegamos\entity\City;

class AddressFactory
{
    public static function fromStdClass(stdClass $jsonObject)
    {
        $address = new Address();
        $city = new City();

        if (self::isValid($jsonObject)) {
            $address->setStreet($jsonObject->street);
            $address->setNumber($jsonObject->number);
            $address->setDistrict($jsonObject->district);

            $city->setName($jsonObject->city);
            $city->setState($jsonObject->state);
            $city->setCountry($jsonObject->country);
        }

        $address->setCity($city);

        return $address;
    }

    private static function isValid(stdClass $jsonObject)
    {
        return
            isset($jsonObject->street) &&
            isset($jsonObject->number) &&
            isset($jsonObject->district) &&
            isset($jsonObject->city) &&
            isset($jsonObject->state) &&
            isset($jsonObject->country);
    }
}
