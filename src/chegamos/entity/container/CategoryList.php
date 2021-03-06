<?php

namespace chegamos\entity\container;

class CategoryList extends ItemsList
{
    public function __construct($data)
    {
        $this->setNumFound(count($data->categories));

        foreach ($data->categories as $category) {
            $this->add(new Category($category->category));
        }
    }
}
