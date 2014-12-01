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
use chegamos\rest\auth\BasicAuth;
use chegamos\rest\client\Guzzle;

class PlaceRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function testGetPlaceById()
    {
        $place = $this
            ->getPlaceRepository($this->loadJsonFor('place'))
            ->get('UCV34B2P');
        $this->assertEquals('Uziel Restaurante - Sao Paulo', $place->getName());
    }

    public function testGetRequestByPlaceId()
    {
        $request = $this
            ->getPlaceRepository($this->loadJsonFor('place'))
            ->byId('UCV34B2P')
            ->getRequest();
        $this->assertEquals('chegamos\rest\Request', get_class($request));
        $this->assertEquals('GET', $request->getVerb());
        $this->assertEquals('places/UCV34B2P', $request->getPath());
        $this->assertEquals('type=json', $request->getQueryString());
    }

    public function testByAddress()
    {
        $city = new City();
        $city->setName('São Paulo');
        $city->setState('SP');

        $address = new Address();
        $address->setCity($city);

        $place = $this
            ->getPlaceRepository($this->loadJsonFor('searchByAddress'))
            ->byAddress($address)
            ->getAll();

        $this->assertEquals(
            'Agencia Dos Correios - Vila Maria',
            $place->getItem(0)->getName()
        );
        $this->assertEquals(
            '+55 (11) 2636-3509',
            $place->getItem(0)->getPhone()->toInternationalStandard()
        );
    }

    public function testGetRequestByCreatePlace()
    {
        $city = new City();
        $city->setName('Sorocaba');
        $city->setState('SP');
        $city->setCountry('BR');

        $address = new Address();
        $address->setStreet('Rua Aclimação');
        $address->setNumber(620);
        $address->setComplement('Esquina');
        $address->setDistrict('Jardim Paulistano');
        $address->setZipcode('18040690');
        $address->setCity($city);

        $place = new Place();
        $place->setName('Bar Tolomeu');
        $place->setAddress($address);

        $savedPlace = $this
            ->getPlaceRepository($this->loadJsonFor('createdPlace'))
            ->save($place);

        $this->assertEquals('NOVOID', $savedPlace->getId());
        $this->assertEquals('Bar Tolomeu', $savedPlace->getName());
    }

    public function testGetAllWithRadius()
    {
        $places = $this
            ->getPlaceRepository($this->loadJsonFor('searchByPoint'))
            ->byPoint(new Point('-23.529366', '-47.467117'))
            ->withRadius(1000000)
            ->withListId('24')
            ->withFacets()
            ->getAll();
    }

    public function testSearchPlacesByListId()
    {
        $request = $this->getPlaceRepository()
            ->byListId('21')
            ->withFacets()
            ->getRequest()->getUrlWithQueryString();

        $this->assertEquals(
            'https://api.apontador.com.br/v2/places/list/21?type=json&facets=1',
            $request
        );
    }

    public function testSearchPlacesByListIdWithState()
    {
        $request = $this->getPlaceRepository()
            ->byListId('21')
            ->withState('sp')
            ->withFacets()
            ->getRequest()->getUrlWithQueryString();

        $this->assertEquals(
            'https://api.apontador.com.br/v2/places/list/21?type=json&state=sp&facets=1',
            $request
        );
    }

    public function testSearchPlacesByListIdWithStateAndCity()
    {
        $request = $this->getPlaceRepository()
            ->byListId('21')
            ->withState('sp')
            ->withCity('São Paulo')
            ->withFacets()
            ->getRequest()->getUrlWithQueryString();

        $this->assertEquals(
            'https://api.apontador.com.br/v2/places/list/21?type=json&state=sp&city=S%C3%A3o+Paulo&facets=1',
            $request
        );
    }

    public function testSearchPlacesByListIdWithStateCityAndDistrict()
    {
        $request = $this->getPlaceRepository()
            ->byListId('21')
            ->withState('SP')
            ->withCity('Guarujá')
            ->withDistrict('Vila Luis Antonio')
            ->withFacets()
            ->getRequest()->getUrlWithQueryString();

        $this->assertEquals(
            'https://api.apontador.com.br/v2/places/list/21?type=json'.
            '&state=SP&city=Guaruj%C3%A1&district=Vila+Luis+Antonio&facets=1',
            $request
        );
    }

    public function testSearchPlacesNearAnAddress()
    {
        $city = new City();
        $city->setName('Sorocaba');
        $city->setState('SP');

        $address = new Address();
        $address->setCity($city);
        $address->setStreet('Av. Barão de Tatuí');
        $address->setNumber('145');

        $request = $this->getPlaceRepository()
            ->byAddress($address)
            ->sortByDistance()
            ->getRequest()->getUrlWithQueryString();

        $this->assertEquals(
            'https://api.apontador.com.br/v2/search/places/byaddress?type=json'.
            '&city=Sorocaba&state=SP&street=Av.+Bar%C3%A3o+de+Tatu%C3%AD&number=145&sort_by=distance',
            $request
        );
    }

    private function getPlaceRepository($json = '')
    {
        $restClient = Mockery::mock('chegamos\rest\client\Guzzle');
        $restClient->shouldReceive('execute')
            ->once()
            ->andReturn($json);

        $config = new Config();
        $config->setBaseUrl('https://api.apontador.com.br/v2/');
        $config->setBasicAuth(
            new BasicAuth('User', 'Pass')
        );
        $config->setRestClient($restClient);

        return new PlaceRepository($config);
    }

    private function loadJsonFor($fileName)
    {
        return file_get_contents(__DIR__ . '/../../../fixtures/' . $fileName . '.json');
    }
}
