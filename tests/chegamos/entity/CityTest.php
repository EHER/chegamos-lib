<?php

namespace chegamos\entity;

use chegamos\util\Inflector;

class CityTest extends \PHPUnit_Framework_TestCase
{

    protected $city;

    protected function setUp()
    {
        $this->city = new City;
    }

    protected function tearDown()
    {
        unset($this->city);
    }

    public function testPopulate()
    {
        $data = new \stdClass();
        $data->name = 'City';
        $data->state = 'State';
        $data->country = 'Country';

        $this->city->populate($data);

        $this->assertEquals('City', $this->city->getName());
        $this->assertEquals('State', $this->city->getState());
        $this->assertEquals('Country', $this->city->getCountry());
    }

    public function testPopulateWithoutData()
    {
        $data = new \stdClass();

        $this->city->populate($data);

        $this->assertEquals('', $this->city->getName());
        $this->assertEquals('', $this->city->getState());
        $this->assertEquals('', $this->city->getCountry());
    }

    public function testPopulateWithDataNull()
    {
        $data = null;

        $this->city->populate($data);

        $this->assertEquals('', $this->city->getName());
        $this->assertEquals('', $this->city->getState());
        $this->assertEquals('', $this->city->getCountry());
    }

    public function testPopulateWithDataZero()
    {
        $data = 0;

        $this->city->populate($data);

        $this->assertEquals('', $this->city->getName());
        $this->assertEquals('', $this->city->getState());
        $this->assertEquals('', $this->city->getCountry());
    }

    public function testPopulateWithStringData()
    {
        $data = "NewData";

        $this->city->populate($data);

        $this->assertEquals('', $this->city->getName());
        $this->assertEquals('', $this->city->getState());
        $this->assertEquals('', $this->city->getCountry());
    }

    public function testPopulateWithArrayData()
    {
        $data = array(
            'City'=>'City',
            'State'=>'State',
            'Country'=>'Country'
        );

        $this->city->populate($data);

        $this->assertEquals('', $this->city->getName());
        $this->assertEquals('', $this->city->getState());
        $this->assertEquals('', $this->city->getCountry());
    }

    public function testToString()
    {
        $this->city->setFormatter(New Inflector());
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
