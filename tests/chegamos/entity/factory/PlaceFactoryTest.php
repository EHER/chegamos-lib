<?php

namespace chegamos\entity\factory;

use chegamos\entity\PlaceInfo;
use chegamos\entity\GasStation;
use chegamos\entity\Address;
use chegamos\entity\City;
use chegamos\entity\Category;
use chegamos\entity\Subcategory;
use chegamos\exception\ChegamosException;

class PlaceFactoryTest extends \PHPUnit_Framework_TestCase 
{
    public function testGenerate() {

        $subCategory = new Subcategory();
        $subCategory->setId(1234);
        $subCategory->setName("Self Service");

        $category = new Category();
        $category->setId(12);
        $category->setName("Restaurantes");
        $category->setSubCategory($subCategory);

        $city = new City();
        $city->setCountry("Brasil");
        $city->setState("SP");
        $city->setName("São Paulo");

        $address = new Address();
        $address->setCity($city);
        $address->setComplement("1 Andar");
        $address->setDistrict("Vila Olimpia");
        $address->setNumber("129");
        $address->setStreet("Rua Funchal");
        $address->setZipcode("04551-069");

        $gasStation = new GasStation(
            array(
                'price_gas' => 1,23,
                'price_vodka' => 23,45
            )
        );

        $placeInfo = new PlaceInfo();
        $placeInfo->setGasStation($gasStation);

        $data = new \stdClass();
        $data->id = 123;
        $data->name = "Chegamos!";
        $data->average_rating = 4;
        $data->review_count = 3;
        $data->category = $category;
        $data->subcategory = $subCategory;
        $data->address = $address;
        $data->point->lat = "-23.529366";
        $data->point->lng = "-47.467117";
        $data->main_url = "http://chegamos.com/";
        $data->other_url = "http://chegamos.com.br/";
        $data->icon_url = "http://chegamos.com/img/icon.png";
        $data->description = "Description";
        $data->created = "01/12/2010 16:19";
        $data->phone = "11 2222-3333";
        $data->extended = $placeInfo;
        $data->num_visitors = 1024;
        $data->num_photos = 5;

        $this->place = PlaceFactory::generate($data);

        $this->assertEquals(123, $this->place->getId());
        $this->assertEquals("Chegamos!", $this->place->getName());
        $this->assertEquals(4, $this->place->getAverageRating());
        $this->assertEquals("Bom", $this->place->getAverageRatingString());
        $this->assertEquals(3, $this->place->getReviewCount());
        $this->assertEquals("chegamos\entity\Category", \get_class((object) $this->place->getCategory()));
        $this->assertEquals("Restaurantes - Self Service", (string) $this->place->getCategory());
        $this->assertEquals("chegamos\entity\Address", \get_class((object) $this->place->getAddress()));
        $this->assertEquals("Rua Funchal, 129 - Vila Olimpia<br/>São Paulo - SP", (string) $this->place->getAddress());
        $this->assertEquals("-23.529366,-47.467117", (string) $this->place->getPoint());
        $this->assertEquals("http://chegamos.com/", $this->place->getMainUrl());
        $this->assertEquals("http://chegamos.com.br/", $this->place->getOtherUrl());
        $this->assertEquals("http://chegamos.com/img/icon.png", $this->place->getIconUrl());
        $this->assertEquals("Description", $this->place->getDescription());
        $this->assertEquals("01/12/2010 16:19", $this->place->getCreated());
        $this->assertEquals("11 2222-3333", $this->place->getPhone());
        $this->assertEquals("chegamos\entity\PlaceInfo", \get_class((object) $this->place->getPlaceInfo()));
        $this->assertEquals(1024, $this->place->getNumVisitors());
        $this->assertEquals(5, $this->place->getNumPhotos());
    }

    public function testGenerateWithoutData() 
    {
        try {
            PlaceFactory::generate(null);
        } catch(ChegamosException $e) {
            $this->assertEquals("Parâmetro data não é um objeto.", $e->getMessage());
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }
}
