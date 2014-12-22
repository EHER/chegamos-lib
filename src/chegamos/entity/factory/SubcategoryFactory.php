<?php

namespace chegamos\entity\factory;

use chegamos\entity\Subcategory;
use chegamos\exception\ChegamosException;

class SubcategoryFactory
{
    public function fromStdClass(\stdClass $subcategoryObject)
    {
        $subcategory = new Subcategory();
        $subcategory->setId($subcategoryObject->id);
        $subcategory->setName($subcategoryObject->name);

        return $subcategory;
    }
}
