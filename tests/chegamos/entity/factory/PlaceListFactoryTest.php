<?php

namespace chegamos\entity\factory;

use chegamos\entity\Phone;
use chegamos\entity\Address;
use chegamos\entity\City;
use chegamos\entity\Category;
use chegamos\entity\Subcategory;
use chegamos\exception\ChegamosException;

class PlaceListFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $placeListJson = <<<JSON
{"search":{
    "result_count":"1",
    "current_page":"1",

    "places":[
    {"place": {
        "id":"X58D9K6B",
        "name":"Haro's Buffet",
        "average_rating":"0",
        "review_count":"0",
        "thumbs":{
            "total":"3",
            "up":"3"
        },
        "category":{
            "id":"20",
            "name":"BUFFETS",
            "subcategory":{
                "id":"20",
                "name":"Buffets e Recep\u00E7\u00F5es"
                }
            },
        "address":{
            "street":"R. MARLENE",
            "number":"327",
            "district":"Nova Gerti",
            "zipcode":"",
            "complement":"",
            "city":{
                "country":"BR",
                "state":"SP",
                "name":"Sao Caetano Do Sul"
                }
            },
        "phone":{
            "country":"55",
            "area":"11",
            "number":"42384913"
        },
        "point":{
            "lat":"-23.64255",
            "lng":"-46.56799"
            },
        "main_url":"http://www.apontador.com.br/local/sp/sao_caetano_do_sul/buffets/X58D9K6B/haro_s_buffet.html",
        "icon_url":"",
        "other_url":"http://www.harosbuffet.com.br/",
        "small_photo_url":"",
        "medium_photo_url":""
        }
    }
    ]
       ,"facets":[
           {
               "name": "district",
               "data": [
                           {
                               "name": "nova gerti",
                               "count": "1"
                           },
                           {
                               "name": "teste são paulo",
                               "count": "1000"
                           }
               ]
           }
           ,
           {
               "name": "city",
               "data": [
                           {
                               "name": "sao caetano do sul",
                               "count": "1"
                           }
               ]
           }
           ,
           {
               "name": "state",
               "data": [
                           {
                               "name": "sp",
                               "count": "1"
                           }
               ]
           }
           ,
           {
               "name": "categoryid",
               "data": [
                           {
                               "name": "20",
                               "count": "1"
                           }
               ]
           }
           ,
           {
               "name": "subcategoryid",
               "data": [
                           {
                               "name": "20",
                               "count": "1"
                           }
               ]
           }
       ]
    }
}
JSON;

        $placeListJsonObject = json_decode($placeListJson);

        $places = PlaceListFactory::generate($placeListJsonObject->search);

        $this->assertEquals(
                "Haro's Buffet",
                $places->getItem(0)->getName()
        );

        $this->assertEquals(
                "+55 (11) 4238-4913",
                $places->getItem(0)->getPhone()->toInternationalStandard()
        );

        $facets = $places->getFacets();

        $this->assertEquals(
                "district",
                $facets[0]->getName()
        );

        $this->assertEquals(
                array(
                        'nova gerti' => 1,
                        'teste são paulo' => 1000,
                ),
                $facets[0]->getData()
        );

        $this->assertEquals(
                array('sao caetano do sul' => 1),
                $facets[1]->getData()
        );
    }

    public function testGenerateWithoutData()
    {
        try {
            PlaceFactory::generate(null);
        } catch (ChegamosException $e) {
            $this->assertEquals(
                "Parâmetro data não é um objeto.",
                $e->getMessage()
            );

            return;
        }
        $this->fail('An expected exception has not been raised.');
    }
}
