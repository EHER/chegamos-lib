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
    public function testGetPlaceById()
    {
        $accessToken = new AccessToken(getenv('ACCESS_TOKEN'));

        $config = new Config();
        $config->setAccessToken($accessToken);
        $config->setRestClient(new Guzzle(new GuzzleClient));
        $config->setBaseUrl('https://api.apontador.com.br/v2/');

        $repository = new PlaceRepository($config);
        $place = $repository->get('A839ALF5');

        var_dump($place);
    }
}
