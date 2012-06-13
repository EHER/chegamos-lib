<?php

namespace chegamos\entity\factory;

use chegamos\entity\PlaceInfo;
use chegamos\entity\GasStation;
use chegamos\entity\Phone;
use chegamos\entity\Address;
use chegamos\entity\City;
use chegamos\entity\Category;
use chegamos\entity\Subcategory;
use chegamos\exception\ChegamosException;

class PlaceFactoryTest extends \PHPUnit_Framework_TestCase
{
	public function testGenerate()
    {
    	$data = $this->getPlaceJsonData();
        
    	$this->place = PlaceFactory::generate($data);

        $this->assertEquals(123, $this->place->getId());
        $this->assertEquals("Chegamos!", $this->place->getName());
        $this->assertEquals(4, $this->place->getAverageRating());
        $this->assertEquals("Bom", $this->place->getAverageRatingString());
        $this->assertEquals(3, $this->place->getReviewCount());
        $this->assertTrue($this->place->getCategory() instanceof Category);
        $this->assertEquals(
            "12",
            (string) $this->place->getCategory()->getId()
        );
        $this->assertEquals(
            "Restaurantes - Self Service",
            (string) $this->place->getCategory()
        );
        $this->assertTrue($this->place->getCategory()->getSubcategory() instanceof Subcategory);
        $this->assertEquals(
            "1234",
            (string) $this->place->getCategory()->getSubcategory()->getId()
        );
        $this->assertEquals(
            "Self Service",
            (string) $this->place->getCategory()->getSubcategory()
        );
        $this->assertTrue($this->place->getAddress() instanceof Address);
        $this->assertEquals(
            "Rua Funchal, 129 - Vila Olimpia<br/>São Paulo - SP",
            (string) $this->place->getAddress()
        );
        $this->assertEquals(
            "-23.529366,-47.467117",
            (string) $this->place->getPoint()
        );
        $this->assertEquals(
            "http://chegamos.com/",
            $this->place->getMainUrl()
        );
        $this->assertEquals(
            "http://chegamos.com.br/",
            $this->place->getOtherUrl()
        );
        $this->assertEquals(
            "http://chegamos.com/img/icon.png",
            $this->place->getIconUrl()
        );
        $this->assertEquals("Description", $this->place->getDescription());
        $this->assertEquals("01/12/2010 16:19", $this->place->getCreated());
        $this->assertTrue($this->place->getPhone() instanceof Phone);
        $this->assertEquals(
            "(11) 2222-3333",
            $this->place->getPhone()
        );
        $this->assertTrue($this->place->getPlaceInfo() instanceof PlaceInfo);
        
        $this->assertEquals(
        	"http://www.apontador.com.br/small_photo",
        	$this->place->getSmallPhotoUrl()
        );
    }
    
    public function getPlaceJsonData()
    {
    	$city = new \stdClass();
    	$city->country = "Brasil";
    	$city->state = "SP";
    	$city->name = "São Paulo";
    
    	$address = new \stdClass();
    	$address->city = $city;
    	$address->complement = "1 Andar";
    	$address->district = "Vila Olimpia";
    	$address->number = 129;
    	$address->street = "Rua Funchal";
    	$address->zipcode = "04551-069";
    
    	$gasStation = new \stdClass();
    	$gasStation->price_gas = 1.23;
    	$gasStation->price_vodka = 23.45;
    
    	$extended = new \stdClass();
    	$extended->gas_station = $gasStation;
    
    	$subcategory = new \stdClass();
    	$subcategory->id = 1234;
    	$subcategory->name = "Self Service";
    
    	$category = new \stdClass();
    	$category->id = 12;
    	$category->name = "Restaurantes";
    	$category->subcategory = $subcategory;
    
    	$data = new \stdClass();
    	$data->id = 123;
    	$data->name = "Chegamos!";
    	$data->average_rating = 4;
    	$data->review_count = 3;
    	$data->category = $category;
    	$data->address = $address;
    	$data->point = new \stdClass();
    	$data->point->lat = "-23.529366";
    	$data->point->lng = "-47.467117";
    	$data->main_url = "http://chegamos.com/";
    	$data->small_photo_url = "http://www.apontador.com.br/small_photo";
    	$data->other_url = "http://chegamos.com.br/";
    	$data->icon_url = "http://chegamos.com/img/icon.png";
    	$data->description = "Description";
    	$data->created = "01/12/2010 16:19";
    	$data->phone = new \stdclass();
    	$data->phone->country = "55";
    	$data->phone->area = "11";
    	$data->phone->number = "22223333";
    	$data->extended = $extended;
    	$data->num_visitors = 1024;
    	$data->num_photos = 5;
    
    	return $data;
    }

    public function testGenerateWithoutData()
    {
        try {
            PlaceFactory::generate(null);
        } catch(ChegamosException $e) {
            $this->assertEquals(
                "Parâmetro data não é um objeto.",
                $e->getMessage()
            );
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }
}
