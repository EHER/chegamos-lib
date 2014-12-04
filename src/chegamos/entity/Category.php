<?php

namespace chegamos\entity;

use chegamos\util\Inflector;

class Category
{
    private $id = "";
    private $name = "";
    private $subcategory = "";

    public function __toString()
    {
        $category = $this->getName();
        $category .= $this->getSubcategory() ? ' - '.$this->getSubcategory() : '';

        return $category;
    }

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

    public function setSubcategory($subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function getSubcategory()
    {
        return $this->subcategory;
    }
}
