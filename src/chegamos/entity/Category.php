<?php

namespace chegamos\entity;

use chegamos\util\Inflector;

/**
 * @package cheamos\entity
 */ 
class Category 
 { 
    private $id = "";
    private $name = "";
    private $subcategory = "";

    /**
     * @param String $data
     */ 
    public function __construct($data = null) {
        $this->populate($data);
    }

    /**
     * @param String $data
     */ 
    public function populate($data) {
        if (isset($data->id)) {
            $this->setId($data->id);
        }
        if (isset($data->name)) {
            $this->setName($data->name);
        }
        if (isset($data->subcategory)) {
            $this->setSubcategory(new Subcategory($data->subcategory));
        }
    }

    /**
     * @return String
     */ 
    public function __toString() {
        $category = $this->getName();
        $category .= $this->getSubcategory() ? ' - ' . $this->getSubcategory() : '';
        return $category;
    }

    /**
     * @param integer $id
     */ 
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return integer
     */ 
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $name
     */ 
    public function setName($name) {
        $this->name = Inflector::formatTitle($name);
    }

    /**
     * @return string
     */ 
    public function getName() {
        return $this->name;
    }

    /**
     * @param Subcategory $subcategory
     */ 
    public function setSubcategory($subcategory) {
        $this->subcategory = $subcategory;
    }

    /**
     * @return Subcategory
     */ 
    public function getSubcategory() {
        return $this->subcategory;
    }
}
