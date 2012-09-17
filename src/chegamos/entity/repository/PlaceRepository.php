<?php

namespace chegamos\entity\repository;

use chegamos\entity\Config;
use chegamos\entity\Place;
use chegamos\entity\Address;
use chegamos\entity\Point;
use chegamos\entity\factory\PlaceFactory;
use chegamos\entity\factory\PlaceListFactory;
use chegamos\rest\Request;

class PlaceRepository
{
    private $config;
    private $requestType;
    private $request;

    public function __construct(Config $config)
    {
        if (!empty($config)) {
            $this->config = $config;
        }

        $this->setup();
    }

    public function get($id = null)
    {
        if (!empty($id)) {
            $this->byId($id);
        }

        $this->getPath();

        $placeJsonString = $this->config
            ->getRestClient()
            ->execute($this->request);
        $this->setup();

        $placeJsonObject = json_decode($placeJsonString);

        return PlaceFactory::generate($placeJsonObject->place);
    }

    public function getAll()
    {
        $this->getPath();

        $placeListJsonString = $this->config
            ->getRestClient()
            ->execute($this->request);
        $this->setup();

        $placeListJsonObject = json_decode($placeListJsonString);

        return PlaceListFactory::generate($placeListJsonObject->search);
    }

    public function save(Place $place)
    {
        $this->requestType = 'savePlace';
        $this->getPath();

        $placeJsonString = $this->config
            ->getRestClient()
            ->execute($this->request);
        $this->setup();

        $placeJsonObject = json_decode($placeJsonString);

        return PlaceFactory::generate($placeJsonObject->place);
    }

    public function withDetails()
    {
        $this->requestType = 'details';

        return $this;
    }

    public function withReviews()
    {
        $this->requestType = 'reviews';

        return $this;
    }

    public function withPhotos()
    {
        $this->requestType = 'photos';

        return $this;
    }

    public function byId($id)
    {
        $this->request->addParam('id', $id);

        return $this;
    }

    public function byZipcode($zipcode)
    {
        $this->requestType = 'placesByZipcode';
        $this->request->addQueryItem("zipcode", $zipcode);

        return $this;
    }

    public function byAddress(Address $address)
    {
        $this->requestType = 'placesByAddress';
        $this->request->addQueryItem("city", $address->getCity()->getName());
        $this->request->addQueryItem("state", $address->getCity()->getState());
        
        return $this;
    }

    public function byListId($listId) {
        $this->request->addParam('listId', $listId);
        $this->requestType = 'placesByListId';

        return $this;
    }

    public function byPoint(Point $point)
    {
        $this->requestType = 'placesByPoint';
        $this->request->addQueryItem("lat", $point->getLat());
        $this->request->addQueryItem("lng", $point->getLng());

        return $this;
    }

    public function byName($name)
    {
        $this->requestType = 'placesByName';
        $this->request->addQueryItem("q", $name);

        return $this;
    }

    public function withName($name)
    {
        $this->request->addQueryItem("term", $name);

        return $this;
    }

    public function withCategoryId($categoryId)
    {
        $this->request->addQueryItem("category_id", $categoryId);

        return $this;
    }

    public function withSubcategoryId($subcategoryId)
    {
        $this->request->addQueryItem("subcategory_id", $subcategoryId);

        return $this;
    }

    public function withListId($listId)
    {
        $this->request->addQueryItem("list_id", $listId);

        return $this;
    }

    public function withLimit($limit)
    {
        $this->request->addQueryItem("limit", $limit);

        return $this;
    }

    public function withRadius($radius)
    {
        $this->request->addQueryItem("radius_mt", $radius);

        return $this;
    }

    public function withState($state)
    {
        $this->request->addQueryItem("state", $state);

        return $this;
    }

    public function withCity($city)
    {
        $this->request->addQueryItem("city", $city);

        return $this;
    }

    public function withDistrict($district)
    {
        $this->request->addQueryItem("district", $district);

        return $this;
    }

    public function withFacets()
    {
        $this->request->addQueryItem("facets", "1");

        return $this;
    }

    public function withFacilities()
    {
        return $this->withUtilities();
    }

    public function withUtilities()
    {
        $this->request->addQueryItem('utilities', '1');
        return $this;
    }

    public function page($page)
    {
        $this->request->addQueryItem("page", $page);

        return $this;
    }

    public function getRequest()
    {
        $this->getPath();
        return $this->request;
    }

    private function setup()
    {
        $this->request = new Request();
        $this->request->setBaseUrl($this->config->getBaseUrl());
        $this->request->addQueryItem("type", "json");
        $this->request->setVerb('GET');

        $basicAuth = $this->config->getBasicAuth();
        if (!empty($basicAuth)) {
            $this->request->setHeader($basicAuth->getHeader());
        }

        $this->requestType = "details";
    }

    private function getPath()
    {
        switch ($this->requestType) {

        case 'details':
            $this->request->setPath("places/" . $this->request->getParam('id'));
            break;
        case 'placesByZipcode':
            $this->request->setPath("search/places/byzipcode");
            break;
        case 'placesByAddress':
            $this->request->setPath("search/places/byaddress");
            break;
        case 'placesByPoint':
            $this->request->setPath("search/places/bypoint");
            break;
        case 'placesByListId':
            $this->request->setPath("places/list/" . $this->request->getParam('listId'));
            break;
        case 'reviews':
            $this->request->setPath(
                "places/" . $this->request->getParam('id') . '/reviews'
            );
            break;
        case 'photos':
            $this->request->setPath(
                "places/" . $this->request->getParam('id') . '/photos'
            );
            break;
        }

        return $this->request->getPath();
    }
}
