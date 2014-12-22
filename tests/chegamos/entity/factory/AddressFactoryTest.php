<?php

namespace chegamos\entity\factory;

use \stdClass;
use chegamos\entity\Category;
use chegamos\exception\ChegamosException;

class AddressFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactoryFromStdClassWithFixtures()
    {
        $placeJson = file_get_contents(__DIR__.'/../../../fixtures/place.json');
        $placeObject = json_decode($placeJson);
        $addressObject = $placeObject->place->address;

        $address = AddressFactory::fromStdClass($addressObject);

        $this->assertEquals('R Cel. Jose Pedro de Oliveira', $address->getStreet());
        $this->assertEquals(678, $address->getNumber());
        $this->assertEquals('Centro', $address->getDistrict());
        $this->assertInstanceOf('chegamos\entity\City', $address->getCity());
        $this->assertEquals('SOROCABA - SP', (string) $address->getCity());
        $this->assertEquals('SP', $address->getCity()->getState());
    }

    public function testFactoryFromStdClassWithDataProvider()
    {
        $address = AddressFactory::fromStdClass(new stdClass);

        $this->assertEquals('', $address->getCity()->getName());
        $this->assertEquals('', $address->getCity()->getState());
        $this->assertEquals('', $address->getCity()->getCountry());
    }
}
