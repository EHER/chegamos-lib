<?php

namespace chegamos\entity;

class Phone
{
    private $country;
    private $area;
    private $number;

    public function __toString()
    {
        return $this->toBrazilianStandard();
    }

    public function toInternationalStandard()
    {
        if (!$this->isValidNumber()) {
            return "";
        }
        
        $countryInfo = isset($this->country) ? "+" . $this->country . " " : "+55 ";
        
        return $countryInfo . $this->toBrazilianStandard();
    }

    public function toBrazilianStandard()
    {
        if (!$this->isValidNumber()) {
            return "";
        }

        $phoneData = "(" . $this->area . ") ";
        $phoneData .= substr($this->number, 0, 4) . "-" . substr($this->number, 4, 4);;

        return $phoneData;
    }

    private function isValidNumber()
    {
        return isset($this->area) && isset($this->number);
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

