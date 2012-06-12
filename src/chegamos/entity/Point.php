<?php

namespace chegamos\entity;

class Point
{
    private $lat;
    private $lng;

    function __construct($lat = null, $lng = null)
    {
   		if (isset($lat)) {
            $this->setLat($lat);
        }
        if (isset($lng)) {
            $this->setLng($lng);
        }
    }

    public function __toString()
    {
        if ($this->getLat() && $this->getLng()) {
            return $this->getLat() . ',' . $this->getLng();
        }
        return '';
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    public function getLng()
    {
        return $this->lng;
    }

    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    public function toJson()
    {
        $json = new \stdClass();
        $json->lat = $this->getLat();
        $json->lng = $this->getLng();

        return $json;
    }
}
