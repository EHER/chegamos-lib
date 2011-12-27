<?php

namespace chegamos\entity\factory;

class GasStationItemFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $gasStationItemFactory = null;
    private $placeJson = <<<JSON
{
    "place": {
        "id": "C40151541B0C3C0C3C",
            "name": "PLATAMO",
            "description": "",
            "click_count": "171",
            "review_count": "1",
            "average_rating": "1",
            "thumbs": {
                "total": "4",
                "up": "3"
            },
            "category": {
                "id": "65",
                "name": "POSTOS DE COMBUSTÍVEL",
                "subcategory": {
                    "id": "65",
                    "name": "Postos de Combustível"
                }
            },
            "address": {
                "street": "AV ENG CARLOS REINALDO MENDES",
                "number": "3540",
                "district": "JD DO PASSO",
                "zipcode": "",
                "complement": "",
                "city": {
                    "country": "BR",
                    "state": "SP",
                    "name": "SOROCABA"
                }
            },
            "phone": {
                "country": "55",
                "area": "15",
                "number": "32113327"
            },
            "created": {
                "timestamp": "2010-07-10T00:00:00",
                "user": {
                    "id": "2424242424",
                    "name": "Combustivel",
                    "photo_large_url": "",
                    "photo_url": "",
                    "photo_medium_url": "",
                    "photo_small_url": ""
                }
            },
            "point": {
                "lat": "-23.4779745",
                "lng": "-47.42203"
            },
            "main_url": "http://www.apontador.com.br/local/sp/sorocaba/postos_de_combustivel/C40151541B0C3C0C3C/platamo.html",
            "icon_url": "",
            "other_url": "",
            "extended": {
                "gas_station": {
                    "price_alcohol": "1.89",
                    "price_biodiesel": "0",
                    "price_diesel": "2.02",
                    "price_diesel_aditivado": "0",
                    "price_gasoline": "2.69",
                    "price_gasoline_aditivada": "2.73",
                    "price_gasoline_podium": "0",
                    "price_gasoline_premium": "3.49",
                    "price_gnv": "0",
                    "price_kerosene": "0",
                    "average_alcohol": "1.76",
                    "average_biodiesel": "0",
                    "average_diesel": "2",
                    "average_diesel_aditivado": "0",
                    "average_gasoline": "2.59",
                    "average_gasoline_aditivada": "2.59",
                    "average_gasoline_podium": "0",
                    "average_gasoline_premium": "3.49",
                    "average_gnv": "1.59",
                    "average_kerosene": "0",
                    "collect_date_alcohol": "2011-10-23T03:22:26",
                    "collect_date_biodiesel": "",
                    "collect_date_diesel": "2011-10-23T03:22:26",
                    "collect_date_diesel_aditivado": "",
                    "collect_date_gasoline": "2011-10-23T03:22:26",
                    "collect_date_gasoline_aditivada": "2011-10-23T03:22:26",
                    "collect_date_gasoline_premium": "2011-10-23T03:22:26",
                    "collect_date_gasoline_podium": "",
                    "collect_date_gasoline_gnv": "",
                    "collect_date_gasoline_kerosene": ""
                }
            }
    }
}
JSON;

    public function Setup()
    {
        $this->gasStationItemFactory = new GasStationItemFactory;
    }

    public function TearDown()
    {
        unset($this->gasStationItemFactory);
    }

    public function testGenerateGasStationItem()
    {
        $place = json_decode($this->placeJson);
        $gasStationData = $place->place->extended->gas_station;
        $gasStationItem = $this->gasStationItemFactory->generate('alcohol', $gasStationData);
        $this->assertEquals("Álcool", $gasStationItem->getLabel());
        $this->assertEquals(1.89, $gasStationItem->getValue());
        $this->assertEquals(1.76, $gasStationItem->getAverageValue());
        $this->assertEquals("23/10 03:22", $gasStationItem->getCollectDate());
    }

    /**
     * @expectedException chegamos\exception\ChegamosException
     */
    public function testGenerateGasStationItemWithAWrongItemName()
    {
        $place = json_decode($this->placeJson);
        $gasStationData = $place->place->extended->gas_station;
        $gasStationItem = $this->gasStationItemFactory->generate('tekila', $gasStationData);
        $this->assertEquals("Álcool", $gasStationItem->getLabel());
        $this->assertEquals(1.89, $gasStationItem->getValue());
        $this->assertEquals(1.76, $gasStationItem->getAverageValue());
        $this->assertEquals("23/10 03:22", $gasStationItem->getCollectDate());
    }
}
