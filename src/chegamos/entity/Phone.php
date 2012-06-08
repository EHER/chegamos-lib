<?php

namespace chegamos\entity;

class Phone
{
    private $country;
    private $area;
    private $number;

    public function __toString()
    {
        $phoneString = "";
        $phoneString .= "+";
        $phoneString .= $this->country;
        $phoneString .= " (";
        $phoneString .= $this->area;
        $phoneString .= ") ";
        $phoneString .= substr($this->number, 0, 4);
        $phoneString .= "-";
        $phoneString .= substr($this->number, 4, 4);
        return $phoneString;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setArea($area)
    {
        $this->area = $area;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
        return $this->number;
    }
}

