<?php

namespace chegamos\entity\repository;

use chegamos\rest\Curl as RestClient;
use Mockery;
use chegamos\rest\client\Guzzle;
use chegamos\entity\Config;
use chegamos\rest\auth\BasicAuth;
use chegamos\entity\City;
use chegamos\entity\Address;
use chegamos\entity\Place;
use chegamos\entity\State;

class PlaceRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPlaceById()
    {
        $placeJson = <<<JSON
{"place": {
    "id":"UCV34B2P",
    "name":"Uziel Restaurante - S\u00E3o Paulo",
    "description": "Um bom restaurante",
    "review_count":"52",
    "average_rating":"4",
    "thumbs":{
        "total":"779",
        "up":"606"
    },
    "category":{
        "id":"67",
        "name":"RESTAURANTES",
        "subcategory":{
            "id":"95267",
            "name":"A Quilo "
        }
    },
    "address":{
        "street":"R Min. Jesuino Cardoso",
        "number":"473",
        "district":"Vila Olimpia",
        "zipcode":"00000000",
        "complement":"",
        "city":{
            "country":"BR",
            "state":"SP",
            "name":"Sao Paulo"
        }
    },
    "phone":{
        "country":"55",
        "area":"11",
        "number":"25793044"
    },
    "created":{
        "timestamp":"2007-08-01T00:00:00",
        "user":{
            "id":"1997653480",
            "name":"Uziel Restaurante",
            "photo_large_url":"http://aptuser.s3.amazonaws.com/1997653480_b.jpg",
            "photo_url":"http://aptuser.s3.amazonaws.com/1997653480_b.jpg",
            "photo_medium_url":"http://aptuser.s3.amazonaws.com/1997653480_m.jpg",
            "photo_small_url":"http://aptuser.s3.amazonaws.com/1997653480_s.jpg"
        }
    },
    "point":{
        "lat":"-23.59260829",
        "lng":"-46.68183288"
    },
    "main_url":"http://www.apontador.com.br/local/sp/sao_paulo/restaurantes/UCV34B2P/uziel_restaurante___sao_paulo.html",
    "icon_url":"http://img218.imageshack.us/img218/5889/logov2pv.jpg",
    "other_url":""
    }
}
JSON;
        $restClient = $this->getMock('chegamos\rest\client\Guzzle', array("execute"));
        $restClient->expects($this->once())
            ->method("execute")
            ->will($this->returnValue($placeJson));

        $config = new Config();
        $config->setBasicAuth(
            new BasicAuth("MyKey", "MySecret")
        );
        $config->setBaseUrl("http://api.apontador.com.br/v1/");
        $config->setRestClient($restClient);

        $placeRepository = new PlaceRepository($config);
        $place = $placeRepository->get("UCV34B2P");
        $this->assertEquals("Uziel Restaurante - São Paulo", $place->getName());
    }

    public function testGetRequestByPlaceId()
    {
        $config = Mockery::mock("chegamos\\entity\\Config");
        $config->shouldReceive('getBaseUrl')->once()->andReturn(
            "http:/api.apontador.com.br/v1/"
        );
        $config->shouldReceive('getBasicAuth')
            ->once()
            ->andReturn(
                new BasicAuth("MyKey", "MySecret")
            );
        $placeRepository = new PlaceRepository($config);
        $request = $placeRepository->byId("UCV34B2P")->getRequest();
        $this->assertEquals("chegamos\\rest\\Request", get_class($request));
        $this->assertEquals("places/UCV34B2P", $request->getPath());
        $this->assertEquals("type=json", $request->getQueryString());
    }

    /**
    * @ignore
    */
    public function testByAddress()
    {
        $placeListJson = <<<JSON
{"search":{
    "result_count":"525341",
    "current_page":"1",
    
    "places":[
    {"place": {
        "id":"JZRRQ52V",
        "name":"Ag\u00EAncia Dos Correios - Vila Maria",
        "average_rating":"1",
        "review_count":"135",
        "thumbs":{
            "total":"306",
            "up":"72"
        },
        "category":{
            "id":"31",
            "name":"CORREIOS",
            "subcategory":{
                "id":"31",
                "name":"Correios"
                }
            },
        "address":{
            "street":"Av Guilherme Cotching",
            "number":"1225",
            "district":"Vila Maria",
            "zipcode":"",
            "complement":"",
            "city":{
                "country":"BR",
                "state":"SP",
                "name":"Sao Paulo"
                }
            },
        "phone":{
            "country":"55",
            "area":"11",
            "number":"26363509"
        },
        "point":{
            "lat":"-23.51822",
            "lng":"-46.58972"
            },
        "main_url":"http://www.apontador.com.br/local/sp/sao_paulo/correios/JZRRQ52V/agancia_dos_correios___vila_maria.html",
        "icon_url":"http://apontador.s3.amazonaws.com/img_2XA36T3X_L.jpg",
        "other_url":"http://www.correios.com.br",
        "small_photo_url":""
        }
    }
    ]
    }
}
JSON;

        $restClient = Mockery::mock("chegamos\\rest\\client\\Guzzle");
        $restClient->shouldReceive('get')
            ->once()
            ->andReturn($placeListJson);

        $config = new Config();
        $config->setBaseUrl('http://api.apontador.com.br/v1/');
        $config->setBasicAuth(
            new BasicAuth("User", "Pass")
        );
        $config->setRestClient($restClient);

        $city = new City();
        $city->setName("São Paulo");
        $city->setState("SP");

        $address = new Address();
        $address->setCity($city);

        $placeRepository = new PlaceRepository($config);
        $place = $placeRepository->byAddress($address)->getAll();
        $this->assertEquals(
            "Agência Dos Correios - Vila Maria",
            $place->getItem(0)->getName()
        );
        $this->assertEquals(
            "+55 (11) 2636-3509",
            $place->getItem(0)->getPhone()
        );
    }

    public function testGetRequestByCreatePlace()
    {
        $placeJson = <<<JSON
{"place": {
    "id":"NOVOID",
    "name":"Bar Tolomeu",
    "description": "Um bom restaurante",
    "review_count":"52",
    "average_rating":"4",
    "thumbs":{
        "total":"779",
        "up":"606"
    },
    "category":{
        "id":"67",
        "name":"RESTAURANTES",
        "subcategory":{
            "id":"95267",
            "name":"A Quilo "
        }
    },
    "address":{
        "street":"R Min. Jesuino Cardoso",
        "number":"473",
        "district":"Vila Olimpia",
        "zipcode":"00000000",
        "complement":"",
        "city":{
            "country":"BR",
            "state":"SP",
            "name":"Sorocaba"
        }
    },
    "phone":{
        "country":"55",
        "area":"11",
        "number":"25793044"
    },
    "created":{
        "timestamp":"2007-08-01T00:00:00",
        "user":{
            "id":"1997653480",
            "name":"Uziel Restaurante",
            "photo_large_url":"http://aptuser.s3.amazonaws.com/1997653480_b.jpg",
            "photo_url":"http://aptuser.s3.amazonaws.com/1997653480_b.jpg",
            "photo_medium_url":"http://aptuser.s3.amazonaws.com/1997653480_m.jpg",
            "photo_small_url":"http://aptuser.s3.amazonaws.com/1997653480_s.jpg"
        }
    },
    "point":{
        "lat":"-23.59260829",
        "lng":"-46.68183288"
    },
    "main_url":"http://www.apontador.com.br/local/sp/sao_paulo/restaurantes/UCV34B2P/uziel_restaurante___sao_paulo.html",
    "icon_url":"http://img218.imageshack.us/img218/5889/logov2pv.jpg",
    "other_url":""
    }
}
JSON;
        $restClient = Mockery::mock("chegamos\\rest\\client\\Guzzle");
        $restClient->shouldReceive('execute')
            ->once()
            ->andReturn($placeJson);

        $config = new Config();
        $config->setBaseUrl('http://api.apontador.com.br/v1/');
        $config->setBasicAuth(
            new BasicAuth("User", "Pass")
        );
        $config->setRestClient($restClient);

        $city = new City();
        $city->setName("Sorocaba");
        $city->setState("SP");
        $city->setCountry("BR");

        $address = new Address();
        $address->setStreet("Rua Aclimação");
        $address->setNumber(620);
        $address->setComplement("Esquina");
        $address->setDistrict("Jardim Paulistano");
        $address->setZipcode("18040690");
        $address->setCity($city);

        $place = new Place();
        $place->setName("Bar Tolomeu");
        $place->setAddress($address);

        $placeRepository = new PlaceRepository($config);
        $savedPlace = $placeRepository->save($place);
        $this->assertEquals("NOVOID", $savedPlace->getId());
        $this->assertEquals("Bar Tolomeu", $savedPlace->getName());
    }
}
