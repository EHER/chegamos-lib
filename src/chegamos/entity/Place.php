<?php

namespace chegamos\entity;

use chegamos\util\Inflector;

class Place
{

    private $id = "";
    private $name = "";
    private $averageRating = 0;
    private $reviewCount = 0;
    private $category = null;
    private $subcategory = null;
    private $address = null;
    private $point = null;
    private $mainUrl = "";
    private $iconUrl = "";
    private $otherUrl = "";
    private $description = "";
    private $created = null;
    private $phone = null;
    private $placeInfo = null;
    private $numVisitors = 0;
    private $numPhotos = 0;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = Inflector::formatTitle($name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setPlaceInfo($placeInfo)
    {
        $this->placeInfo = $placeInfo;
    }

    public function getPlaceInfo()
    {
        return $this->placeInfo;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setAverageRating($averageRating)
    {
        $this->averageRating = $averageRating;
    }

    public function getAverageRating()
    {
        return $this->averageRating;
    }

    public function getAverageRatingString()
    {
        switch ($this->getAverageRating()) {
        case 1:
            return "Péssimo";
        case 2:
            return "Ruim";
        case 3:
            return "Regular";
        case 4:
            return "Bom";
        case 5:
            return "Excelente";
        default:
            return '';
            break;
        }
    }

    public function setReviewCount($reviewCount)
    {
        $this->reviewCount = $reviewCount;
    }

    public function getReviewCount()
    {
        return $this->reviewCount;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getSubcategory()
    {
        return $this->subcategory;
    }

    public function setSubcategory($subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setPoint($point)
    {
        $this->point = $point;
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function setMainUrl($mainUrl)
    {
        $this->mainUrl = $mainUrl;
    }

    public function getMainUrl()
    {
        return $this->mainUrl;
    }

    public function setOtherUrl($otherUrl)
    {
        $this->otherUrl = $otherUrl;
    }

    public function getOtherUrl()
    {
        return $this->otherUrl;
    }

    public function setIconUrl($iconUrl)
    {
        $this->iconUrl = $iconUrl;
    }

    public function getIconUrl()
    {
        return $this->iconUrl;
    }

    public function setNumVisitors($numVisitors)
    {
        $this->numVisitors = $numVisitors;
    }

    public function getNumVisitors()
    {
        return $this->numVisitors;
    }

    public function setNumPhotos($numPhotos)
    {
        $this->numPhotos = $numPhotos;
    }

    public function getNumPhotos()
    {
        return $this->numPhotos;
    }

    public function getShortPlaceUrl()
    {
        return ROOT_URL . 'places/show/' . $this->getId();
    }

    public function getPlaceUrl()
    {
        $state = \strtolower($this->getAddress()->getCity()->getState());
        $state = \strtolower(Inflector::slug($state));
        $city = \strtolower($this->getAddress()->getCity()->getName());
        $city = \strtolower(Inflector::slug($city));
        $category = \strtolower(Inflector::slug($this->getCategory()));
        $name = \strtolower(Inflector::slug($this->getName()));
        $id = $this->getId();

        return ROOT_URL .  $state .  '/' . $city .  '/' .
            $category.  '/' . $name .  '/' . $id .  '.html';
    }

    public function getMapUrl()
    {
        if ($this->getPoint()->getLat() && $this->getPoint()->getLng()) {
            $mapUrl = "http://maplink.com.br/widget";

            $params = array();

            $params['v'] = '4.1';
            $params['lat'] = $this->getPoint()->getLat();
            $params['lng'] = $this->getPoint()->getLng();

            return $mapUrl . '?' . http_build_query($params);
        }
        return false;
    }

    public function getRouteUrl($location)
    {
        $routeUrl = "http://maps.google.com.br/m/directions";

        $params = array();

        $params['dirflg'] = 'd';

        $params['daddr'] = $this->address->getRouteAddress();

        if ($location->getAddress() instanceof Address) {
            $params['saddr'] = $location->getAddress()->getRouteAddress();
        }

        return $routeUrl . '?' . http_build_query($params);
    }
}
