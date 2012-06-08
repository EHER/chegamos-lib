<?php

namespace chegamos\entity\factory;

use chegamos\entity\Phone;

class PhoneRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $data = new \stdClass();
        $data->country = "55";
        $data->area = "11";
        $data->number = "26363509";

        $phone = PhoneFactory::generate($data);

        $this->assertEquals("55", $phone->getCountry());
        $this->assertEquals("11", $phone->getArea());
        $this->assertEquals("26363509", $phone->getNumber());
    }
}
