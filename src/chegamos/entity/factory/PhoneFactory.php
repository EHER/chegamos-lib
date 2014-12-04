<?php

namespace chegamos\entity\factory;

use chegamos\entity\Phone;

class PhoneFactory
{
    public static function generate(\stdClass $data)
    {
        $phone = new Phone();
        $phone->setCountry($data->country);
        $phone->setArea($data->area);
        $phone->setNumber($data->number);

        return $phone;
    }
}
