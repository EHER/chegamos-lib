<?php

namespace chegamos\entity\repository;

use chegamos\entity\Place;
use chegamos\entity\Address;
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

    public function save(Place $place)
    {
        $this->requestType = 'save';

        $this->query['name'] = $place->getName();
        $this->query['address_street'] = $place->getAddress()->getStreet();
        $this->query['address_number'] = $place->getAddress()->getNumber();
        $this->query['address_complement'] = $place->getAddress()
            ->getComplement();
        $this->query['address_district'] = $place->getAddress()
            ->getDistrict();
        $this->query['address_city_name'] = $place->getAddress()
            ->getCity()->getName();
        $this->query['address_city_state'] = $place->getAddress()
            ->getCity()->getState();
        $this->query['address_city_country'] = $place->getAddress()
            ->getCity()->getCountry();
        $this->query['point_lat'] = $place->getPoint()->getLat();
        $this->query['point_lng'] = $place->getPoint()->getLng();
        //$this->query['phone_country'] = $place->getPhone()
        //->getCountry();
        //$this->query['phone_area'] = $place->getPhone()
        //->getArea();
        $this->query['phone_number'] = $place->getPhone();
        $this->query['category_id'] = $place->getCategory()->getId();
        $this->query['subcategory_id'] = $place->getCategory()
            ->getSubcategory()->getId();
        $this->query['description'] = $place->getDescription();
        $this->query['icon_url'] = $place->getIconUrl();
        $this->query['other_url'] = $place->getOtherUrl();


        $placeJsonString = $this->restClient->put(
            $this->getPath() . '?' . $this->getQueryString()
        );
        $this->setup();

        var_dump($placeJsonString);
        exit;

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

        case 'save':
            $path = "places/create";
            break;
        case 'details':
            $path = "places/" . $this->param['id'];
            break;
        case 'placesByZipcode':
            $path = "search/places/byzipcode";
            break;
        case 'placesByAddress':
            $path = "search/places/byaddress";
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
