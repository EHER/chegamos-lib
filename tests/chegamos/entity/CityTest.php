<?php

namespace chegamos\entity;

use chegamos\util\Inflector;

class CityTest extends \PHPUnit_Framework_TestCase
{
    protected $city;

    protected function setUp()
    {
        $this->city = new City();
    }

    protected function tearDown()
    {
        unset($this->city);
    }

    public function testToString()
    {
        $this->city->setFormatter(new Inflector());
        $this->city->setName('city');
        $this->assertEquals('City', (string) $this->city);
        $this->city->setName('CITY');
        $this->assertEquals('City', (string) $this->city);
    }

    public function testToStringWithoutFormatter()
    {
        $this->city->setFormatter(null);
        $this->city->setName('city');
        $this->assertEquals('city', (string) $this->city);
        $this->city->setName('CITY');
        $this->assertEquals('CITY', (string) $this->city);
        $this->city->setName('City');
        $this->assertEquals('City', (string) $this->city);
    }

    public function testSetGetCountry()
    {
        $this->city->setCountry('country');
        $this->assertEquals('country', $this->city->getCountry());
        $this->city->setCountry('Country');
        $this->assertEquals('Country', $this->city->getCountry());
    }

    public function testSetGetState()
    {
        $this->city->setState('state');
        $this->assertEquals('state', $this->city->getState());
        $this->city->setState('State');
        $this->assertEquals('State', $this->city->getState());
    }

    public function testSetGetName()
    {
        $this->city->setName('city');
        $this->assertEquals('city', $this->city->getName());
        $this->city->setName('City');
        $this->assertEquals('City', $this->city->getName());
    }
}
