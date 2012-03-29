<?php

namespace chegamos\entity\repository;

use chegamos\rest\client\Guzzle;
use chegamos\entity\Config;
use chegamos\rest\auth\BasicAuth;

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
        $restClient = $this->getMock('RestClient', array("get"));
        $restClient->expects($this->any())
            ->method("get")
            ->will($this->returnValue($placeJson));

        $config = new Config();
        $config->setBasicAuth(new BasicAuth("MyKey", "MySecret"));
        $config->setBaseUrl("http://api.apontador.com.br/v1/");
        $config->setRestClient(new Guzzle());

        $placeRepository = new PlaceRepository($config);
        $place = $placeRepository->get("UCV34B2P");
        $this->assertEquals("Uziel Restaurante - São Paulo", $place->getName());

        $request = $placeRepository->byId("UCV34B2P")->getRequest();
        $this->assertEquals("chegamos\\rest\\Request", get_class($request));
        $this->assertEquals("places/UCV34B2P", $request->getPath());
        $this->assertEquals("type=json", $request->getQueryString());
    }
}
