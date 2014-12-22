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
    public function testFactoryFromJson()
    {
        $placeJson = file_get_contents(__DIR__.'/../../../fixtures/place.json');
        $placeFactory = new PlaceFactory;
        $place = $placeFactory->fromJson($placeJson);

        $this->assertEquals('A839ALF5', $place->getId());
        $this->assertEquals('Gpaci Hospital do Cancer Infantil de Sorocaba', $place->getName());
        $this->assertEquals(5, $place->getAverageRating());
        $this->assertEquals('Excelente', $place->getAverageRatingString());
        $this->assertEquals(19, $place->getReviewCount());
        $this->assertInstanceOf('chegamos\entity\Category', $place->getCategory());
        $this->assertEquals(5, $place->getCategory()->getId());
        $this->assertEquals('Hospitais e Postos de Saúde - Hospitais', (string) $place->getCategory());
        $this->assertInstanceOf('chegamos\entity\Subcategory', $place->getCategory()->getSubcategory());
        $this->assertEquals(5, $place->getCategory()->getSubcategory()->getId());
        $this->assertEquals('Hospitais', (string) $place->getCategory()->getSubcategory());
        $this->assertInstanceOf('chegamos\entity\Address', $place->getAddress());
        $this->assertEquals(
            'R Cel. Jose Pedro de Oliveira, 678 - Centro<br/>SOROCABA - SP',
            (string) $place->getAddress()
        );
        $this->assertEquals("-23.5137,-47.4645", (string) $place->getPoint());
        $this->assertEquals(
            'http://www.apontador.com.br/local/sp/sorocaba/hospitais_e_postos_de_saude/A839ALF5/gpaci_hospital_do_cancer_infantil_de_sorocaba.html',
            $place->getMainUrl()
        );
        $this->assertEquals(
            "#other-url",
            $place->getOtherUrl()
        );
        $this->assertTrue($place->getPhone() instanceof Phone);
        $this->assertEquals(
            "(15) 2101-6555",
            (string) $place->getPhone()
        );
        //$this->assertTrue($place->getPlaceInfo() instanceof PlaceInfo);

        //$this->assertEquals(
        //    "http://www.apontador.com.br/small_photo",
        //    $place->getSmallPhotoUrl()
        //);

        //$this->assertEquals(
        //    "http://www.apontador.com.br/medium_photo",
        //    $place->getMediumPhotoUrl()
        //);
    }

    public function testFactoryFromStdClass()
    {
        $placeJson = file_get_contents(__DIR__.'/../../../fixtures/place.json');
        $placeObject = json_decode($placeJson);

        $placeFactory = new PlaceFactory;
        $place = $placeFactory->fromStdClass($placeObject);

        $this->assertEquals('A839ALF5', $place->getId());
        $this->assertEquals('Gpaci Hospital do Cancer Infantil de Sorocaba', $place->getName());
        $this->assertEquals(5, $place->getAverageRating());
        $this->assertEquals('Excelente', $place->getAverageRatingString());
        $this->assertEquals(19, $place->getReviewCount());
        $this->assertInstanceOf('chegamos\entity\Category', $place->getCategory());
        $this->assertEquals(5, $place->getCategory()->getId());
        $this->assertEquals('Hospitais e Postos de Saúde - Hospitais', (string) $place->getCategory());
        $this->assertInstanceOf('chegamos\entity\Subcategory', $place->getCategory()->getSubcategory());
        $this->assertEquals(5, $place->getCategory()->getSubcategory()->getId());
        $this->assertEquals('Hospitais', (string) $place->getCategory()->getSubcategory());
        $this->assertInstanceOf('chegamos\entity\Address', $place->getAddress());
        $this->assertEquals(
            'R Cel. Jose Pedro de Oliveira, 678 - Centro<br/>SOROCABA - SP',
            (string) $place->getAddress()
        );
        $this->assertEquals("-23.5137,-47.4645", (string) $place->getPoint());
        $this->assertEquals(
            'http://www.apontador.com.br/local/sp/sorocaba/hospitais_e_postos_de_saude/A839ALF5/gpaci_hospital_do_cancer_infantil_de_sorocaba.html',
            $place->getMainUrl()
        );
        $this->assertEquals(
            "#other-url",
            $place->getOtherUrl()
        );
        $this->assertTrue($place->getPhone() instanceof Phone);
        $this->assertEquals(
            "(15) 2101-6555",
            (string) $place->getPhone()
        );
    }

    /**
     * @dataProvider getInvalidJson
     */
    public function testFromJsonWithInvalidData($invalidJson)
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
