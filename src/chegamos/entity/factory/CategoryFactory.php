<?php

namespace chegamos\entity\factory;

use chegamos\entity\Category;
use chegamos\entity\Subcategory;
use chegamos\exception\ChegamosException;

class CategoryFactory
{
    public static function generate($data)
    {
        if (is_object($data)) {
            $category = new Category();
            if (isset($data->id)) {
                $category->setId($data->id);
            }
            if (isset($data->name)) {
                $category->setName($data->name);
            }
            if (isset($data->subcategory)) {
                $category->setSubcategory(new Subcategory($data->subcategory));
            }
            return $category;
        } else {
            throw new ChegamosException("Parâmetro data não é um objeto.");
        }
    }
}
