<?php

namespace chegamos\entity\repository;

use Mockery;
use PHPUnit_Framework_TestCase;
use chegamos\entity\Address;
use chegamos\entity\City;
use chegamos\entity\Config;
use chegamos\entity\Place;
use chegamos\entity\Point;
use chegamos\entity\State;
use chegamos\rest\client\Guzzle;
use chegamos\rest\auth\AccessToken;
use GuzzleHttp\Client as GuzzleClient;

class PlaceRepositoryIntegrationTest extends PHPUnit_Framework_TestCase
{
    private $repository;

    public function setUp()
    {
        $accessToken = new AccessToken(getenv('ACCESS_TOKEN'));

        $config = new Config();
        $config->setAccessToken($accessToken);
        $config->setRestClient(new Guzzle(new GuzzleClient));
        $config->setBaseUrl('https://api.apontador.com.br/v2/');

        $this->repository = new PlaceRepository($config);
    }

    public function testGetPlaceById()
    {
        $place = $this->repository->get('A839ALF5');
        $this->assertEquals('Gpaci Hospital do Cancer Infantil de Sorocaba', $place->getName());
    }

    public function testSearchPlaceByName()
    {
        $placeList = $this->repository->byName('GPACI')->getAll();
        $this->assertEquals('Gpaci Hospital do Cancer Infantil de Sorocaba', $placeList->getItem()->getName());
    }

    public function testSearchPlaceByListId()
    {
        $placeList = $this->repository->byName('GPACI')->withCity('Sorocaba')->withState('SP')->withListId(22)->getAll();
        $this->assertEquals('Gpaci Hospital do Cancer Infantil de Sorocaba', $placeList->getItem()->getName());
    }
}
