<?php

namespace chegamos\entity;


class PlaceTest extends \PHPUnit_Framework_TestCase
{
    protected $place;

    protected function setUp()
    {
        $this->place = new Place();
    }

    protected function tearDown()
    {
        unset($this->place);
    }

    public function testSetGetId()
    {
        $this->place->setId(123);
        $this->assertEquals(123, $this->place->getId());
    }

    public function testSetGetName()
    {
        $this->place->setName("Chegamos!");
        $this->assertEquals("Chegamos!", $this->place->getName());
    }

    public function testSetGetCreated()
    {
        $this->place->setCreated("01/12/2010 13:27");
        $this->assertEquals("01/12/2010 13:27", $this->place->getCreated());
    }

    public function testSetGetPlaceInfo()
    {
        $this->place->setPlaceInfo("Place Info?");
        $this->assertEquals("Place Info?", $this->place->getPlaceInfo());
    }

    public function testSetGetPhone()
    {
        $this->place->setPhone("Place Info?");
        $this->assertEquals("Place Info?", $this->place->getPhone());
    }

    public function testSetGetDescription()
    {
        $this->place->setDescription("Description");
        $this->assertEquals("Description", $this->place->getDescription());
    }

    public function testSetGetAverageRating()
    {
        $this->place->setAverageRating(1);
        $this->assertEquals(1, $this->place->getAverageRating());
        $this->place->setAverageRating(2);
        $this->assertEquals(2, $this->place->getAverageRating());
        $this->place->setAverageRating(3);
        $this->assertEquals(3, $this->place->getAverageRating());
        $this->place->setAverageRating(4);
        $this->assertEquals(4, $this->place->getAverageRating());
        $this->place->setAverageRating(5);
        $this->assertEquals(5, $this->place->getAverageRating());
    }

    //	public function testSetGetAverageRatingString() {
    //		$this->place->setAverageRatingString("String");
    //		$this->assertEquals("String", $this->place->getAverageRatingString());
    //	}

    public function testSetGetReviewCount()
    {
        $this->place->setReviewCount(3);
        $this->assertEquals(3, $this->place->getReviewCount());
    }

    public function testSetGetCategory()
    {
        $this->place->setCategory("String");
        $this->assertEquals("String", $this->place->getCategory());
    }

    public function testSetGetAddress()
    {
        $this->place->setAddress("Address");
        $this->assertEquals("Address", $this->place->getAddress());
    }

    public function testSetGetPoint()
    {
        $point = new Point();
        $point->setLat("-23.529366");
        $point->setLng("-47.467117");

        $this->place->setPoint($point);
        $this->assertEquals(
            "-23.529366,-47.467117",
            (string) $this->place->getPoint()
        );
    }

    public function testSetGetMainUrl()
    {
        $this->place->setMainUrl("http://chegamos.com/");
        $this->assertEquals(
            "http://chegamos.com/",
            $this->place->getMainUrl()
        );
    }

    public function testSetGetOtherUrl()
    {
        $this->place->setOtherUrl("http://chegamos.com/");
        $this->assertEquals(
            "http://chegamos.com/",
            $this->place->getOtherUrl()
        );
    }

    public function testSetGetIconUrl()
    {
        $this->place->setIconUrl("http://chegamos.com/img/logo.jpg");
        $this->assertEquals(
            "http://chegamos.com/img/logo.jpg",
            $this->place->getIconUrl()
        );
    }
}
