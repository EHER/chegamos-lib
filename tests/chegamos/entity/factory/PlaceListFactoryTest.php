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
    public function testFromJson()
    {
        $placeListJson = file_get_contents(__DIR__.'/../../../fixtures/search.json');

        $places = PlaceListFactory::fromJson($placeListJson);

        $this->assertEquals(
            'Gpaci Hospital do Cancer Infantil de Sorocaba',
            $places->getItem(0)->getName()
        );

        $this->assertEquals(
            '+55 (15) 2101-6555',
            $places->getItem(0)->getPhone()->toInternationalStandard()
        );

        //$facets = $places->getFacets();

        //$this->assertEquals(
        //    "district",
        //    $facets[0]->getName()
        //);

        //$this->assertEquals(
        //    array(
        //        'nova gerti' => 1,
        //        'teste são paulo' => 1000,
        //    ),
        //    $facets[0]->getData()
        //);

        //$this->assertEquals(
        //    array('sao caetano do sul' => 1),
        //    $facets[1]->getData()
        //);
    }

    /**
     * @dataProvider getInvalidJson
     */
    public function testFromJsonWithInvalidJson($invalidJson)
    {
        try {
            PlaceFactory::fromJson($invalidJson);
        } catch (ChegamosException $e) {
            $this->assertEquals(
                "Parâmetro data não é um objeto.",
                $e->getMessage()
            );

            return;
        }
        $this->fail('An expected exception has not been raised.');
    }

    public function getInvalidJson()
    {
        return [
            [null],
            [''],
            [0],
            [1],
        ];
    }
}
