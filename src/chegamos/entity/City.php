<?php

namespace chegamos\entity;

class City
{
    private $country = "";
    private $state = "";
    private $name = "";
    private $formatter = null;

    public function __toString()
    {
        $state =  $this->getState() ? ' - '.$this->getState() : '';

        return $this->format($this->getName()).$state;
    }

    public function setFormatter($formatter)
    {
        $this->formatter = $formatter;
    }

    public function format($string = '', $type = 'formatTitle')
    {
        if (empty($this->formatter)) {
            return $string;
        } else {
            return $this->formatter->$type($string);
        }
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
