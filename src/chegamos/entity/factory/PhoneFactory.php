<?php

namespace chegamos\entity\factory;

use chegamos\entity\Phone;

class PhoneFactory
{
    public static function fromStdClass(\stdClass $data)
    {
        $phone = new Phone();
        $phone->setCountry($data->country);
        $phone->setArea($data->area);
        $phone->setNumber($data->number);

        return $phone;
    }

    public static function fromString($data)
    {
        $phone = new Phone();

        if (strlen($data) === 12) {
            $phone->setCountry(substr($data, 0, 2));
            $phone->setArea(substr($data, 2, 2));
            $phone->setNumber(substr($data, 4, 8));
        }

        return $phone;
    }
}
