<?php

namespace chegamos\entity\factory;

use chegamos\entity\Category;
use chegamos\entity\Subcategory;
use chegamos\entity\factory\SubcategoryFactory;
use chegamos\exception\ChegamosException;

class CategoryFactory
{
    public static function generate($categoryJsonObject)
    {
        if (is_object($categoryJsonObject)) {
            $category = new Category();
            $category->setId($categoryJsonObject->id);
            $category->setName($categoryJsonObject->name);
            $category->setSubcategory(
                SubcategoryFactory::generate($categoryJsonObject->subcategory)
            );
            return $category;
        } else {
            throw new ChegamosException("Parâmetro passado não é um objeto.");
        }
    }
}
