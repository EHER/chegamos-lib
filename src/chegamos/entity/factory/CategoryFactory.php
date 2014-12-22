<?php

namespace chegamos\entity\factory;

use chegamos\entity\Category;
use chegamos\entity\Subcategory;
use chegamos\exception\ChegamosException;

class CategoryFactory
{
    public static function fromStdClass(\stdClass $jsonObject)
    {
        $subcategoryFactory = new SubcategoryFactory();

        $category = new Category();
        $category->setId($jsonObject->id);
        $category->setName($jsonObject->name);
        $category->setSubcategory($subcategoryFactory->fromStdClass($jsonObject->subcategory));

        return $category;
    }
}
