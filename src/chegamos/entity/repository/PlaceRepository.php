<?php

namespace chegamos\entity\repository;

use chegamos\entity\Address;
use chegamos\entity\Config;
use chegamos\entity\Place;
use chegamos\entity\Point;
use chegamos\entity\factory\PlaceFactory;
use chegamos\entity\factory\PlaceListFactory;
use chegamos\rest\Request;

class PlaceRepository extends AbstractRepository
{
    public function __construct(Config $config)
    {
        parent::__construct($config);
        $this->request->setPath('places/{id}');
    }

    public function get($id)
    {
        $this->byId($id);

        $placeJsonString = $this->config->getRestClient()->execute($this->request);
        $this->resetRequest();

        $placeJsonObject = json_decode($placeJsonString);

        return PlaceFactory::generate($placeJsonObject->place);
    }

    public function getAll()
    {
        $placeListJsonString = $this->config->getRestClient()->execute($this->request);
        $this->resetRequest();

        $placeListJsonObject = json_decode($placeListJsonString);

        return PlaceListFactory::generate($placeListJsonObject->search);
    }

    public function save(Place $place)
    {
        $this->requestType = 'savePlace';

        $placeJsonString = $this->config->getRestClient()->execute($this->request);
        $this->resetRequest();

        $placeJsonObject = json_decode($placeJsonString);

        return PlaceFactory::generate($placeJsonObject->place);
    }

    public function withDetails()
    {
        $this->request->setPath('places/{id}');

        return $this;
    }

    public function withReviews()
    {
        $this->request->setPath('places/{id}/reviews');

        return $this;
    }

    public function withPhotos()
    {
        $this->request->setPath('places/{id}/photos');

        return $this;
    }

    public function byId($id)
    {
        $this->request->addParam('id', $id);

        return $this;
    }

    public function byZipcode($zipcode)
    {
        $this->request->setPath('search/places/byzipcode');
        $this->request->addQueryItem('zipcode', $zipcode);

        return $this;
    }

    public function byAddress(Address $address)
    {
        $this->request->setPath('search/places/byaddress');
        $this->request->addQueryItem('city', $address->getCity()->getName());
        $this->request->addQueryItem('state', $address->getCity()->getState());
        $this->request->addQueryItem('street', $address->getStreet());
        $this->request->addQueryItem('number', $address->getNumber());

        return $this;
    }

    public function byListId($listId)
    {
        $this->request->addParam('listId', $listId);
        $this->request->setPath('places/list/{listId}');

        return $this;
    }

    public function byPoint(Point $point)
    {
        $this->request->setPath('search/places/bypoint');
        $this->request->addQueryItem('lat', $point->getLat());
        $this->request->addQueryItem('lng', $point->getLng());

        return $this;
    }

    public function byName($name)
    {
        $this->requestType = 'placesByName';
        $this->request->addQueryItem('q', $name);

        return $this;
    }

    public function withName($name)
    {
        $this->request->addQueryItem('term', $name);

        return $this;
    }

    public function withCategoryId($categoryId)
    {
        $this->request->addQueryItem('category_id', $categoryId);

        return $this;
    }

    public function withSubcategoryId($subcategoryId)
    {
        $this->request->addQueryItem('subcategory_id', $subcategoryId);

        return $this;
    }

    public function withListId($listId)
    {
        $this->request->addQueryItem('list_id', $listId);

        return $this;
    }

    public function withLimit($limit)
    {
        $this->request->addQueryItem('limit', $limit);

        return $this;
    }

    public function withRadius($radius)
    {
        $this->request->addQueryItem('radius_mt', $radius);

        return $this;
    }

    public function withState($state)
    {
        $this->request->addQueryItem('state', $state);

        return $this;
    }

    public function withCity($city)
    {
        $this->request->addQueryItem('city', $city);

        return $this;
    }

    public function withDistrict($district)
    {
        $this->request->addQueryItem('district', $district);

        return $this;
    }

    public function withFacets()
    {
        $this->request->addQueryItem('facets', '1');

        return $this;
    }

    public function withUtilities()
    {
        $this->request->addQueryItem('utilities', '1');
        return $this;
    }

    public function withRecommendations()
    {
        $this->request->addQueryItem('qt', 'recomendados');
        return $this;
    }

    public function sortByDistance()
    {
        $this->request->addQueryItem('sort_by', 'distance');
        return $this;
    }

    public function page($page)
    {
        $this->request->addQueryItem('page', $page);

        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }
}
