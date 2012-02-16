<?php

namespace chegamos\entity\repository;

use chegamos\entity\Address;
use chegamos\entity\Point;
use chegamos\entity\factory\PlaceFactory;
use chegamos\entity\factory\PlaceListFactory;

class PlaceRepository
{
    private $restClient;
    private $requestType;
    private $query;
    private $param;

    public function __construct($restClient)
    {
        $this->restClient = $restClient;
        $this->setup();
    }

    public function get($id = null)
    {
        if (!empty($id)) {
            $this->byId($id);
        }

        $placeJsonString = $this->restClient->get(
            $this->getPath() . '?' . $this->getQueryString()
        );
        $this->setup();

        $placeJsonObject = json_decode($placeJsonString);
        return PlaceFactory::generate($placeJsonObject->place);
    }

    public function getAll()
    {
        $placeListJsonString = $this->restClient->get(
            $this->getPath() . '?' . $this->getQueryString()
        );
        $this->setup();

        $placeListJsonObject = json_decode($placeListJsonString); 
        return PlaceListFactory::generate($placeListJsonObject->search);
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
        $this->param['id'] = $id;
        return $this;
    }

    public function byZipcode($zipcode)
    {
        $this->requestType = 'placesByZipcode';
        $this->query['zipcode'] = $zipcode;
        return $this;
    }

    public function byAddress(Address $address)
    {
        $this->requestType = 'placesByAddress';
        $this->query['city'] = $address->getCity()->getName();
        $this->query['state'] = $address->getCity()->getState();
        return $this;
    }

    public function byPoint(Point $point)
    {
        $this->requestType = 'placesByPoint';
        $this->query['lat'] = $point->getLat();
        $this->query['lng'] = $point->getLng();
        return $this;
    }

    public function byName($name)
    {
        $this->requestType = 'placesByName';
        $this->query['q'] = $name;
        return $this;
    }

    public function withName($name)
    {
        $this->query['term'] = $name;
        return $this;
    }

    public function withCategoryId($categoryId)
    {
        $this->query['category_id'] = $categoryId;
        return $this;
    }

    public function withSubcategoryId($subcategoryId)
    {
        $this->query['subcategory_id'] = $subcategoryId;
        return $this;
    }

    public function withListId($listId)
    {
        $this->query['list_id'] = $listId;
        return $this;
    }

    public function page($page)
    {
        $this->query['page'] = $page;
        return $this;
    }

    private function setup()
    {
        $this->requestType = "details";
        $this->query = array();
        $this->query['type'] = 'json';
        $this->param = array();
    }

    private function getQueryString()
    {
        return http_build_query($this->query);
    }

    private function getPath()
    {
        switch ($this->requestType) {

        case 'details':
            $path = "places/" . $this->param['id'];
            break;
        case 'placesByZipcode':
            $path = "search/places/byzipcode";
            break;
        case 'placesByAddress':
            $path = "search/places/byaddress";
            break;
        case 'placesByPoint':
            $path = "search/places/bypoint";
            break;
        case 'reviews':
            $path = "places/" . $this->param['id'] . '/reviews';
            break;
        case 'photos':
            $path = "places/" . $this->param['id'] . '/photos';
            break;
        }
        return $path;
    }
}
