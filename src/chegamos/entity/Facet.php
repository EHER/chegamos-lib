<?php

namespace chegamos\entity;

class Facet
{
    private $data;
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
        $this->data = array();
    }

    public function add($name, $value)
    {
        $this->data[$name] = (int) $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getData()
    {
        return $this->data;
    }
}
