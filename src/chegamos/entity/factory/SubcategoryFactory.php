<?php

namespace chegamos\entity\factory;

use chegamos\entity\Subcategory;
use chegamos\exception\ChegamosException;

class SubcategoryFactory
{
    public static function generate($subcategoryJsonObject)
    {
        if (is_object($subcategoryJsonObject)) {
            $subcategory = new Subcategory();

            $subcategory->setId($subcategoryJsonObject->id);
            $subcategory->setName($subcategoryJsonObject->name);

            return $subcategory;
        } else {
            throw new ChegamosException("Parâmetro passado não é um objeto.");
        }
    }
}
