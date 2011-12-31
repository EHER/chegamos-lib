<?php

namespace chegamos\entity\factory;

use chegamos\entity\Category;
use chegamos\entity\Subcategory;
use chegamos\exception\ChegamosException;

class CategoryFactory
{
    public static function generate($categoryJsonObject)
    {
        if (is_object($categoryJsonObject)) {
            $category = new Category();
            if (isset($categoryJsonObject->id)) {
                $category->setId($categoryJsonObject->id);
            }
            if (isset($categoryJsonObject->name)) {
                $category->setName($categoryJsonObject->name);
            }
            if (isset($categoryJsonObject->subcategory)) {
                $category->setSubcategory(
                    new Subcategory($categoryJsonObject->subcategory)
                );
            }
            return $category;
        } else {
            throw new ChegamosException("Parâmetro data não é um objeto.");
        }
    }
}
