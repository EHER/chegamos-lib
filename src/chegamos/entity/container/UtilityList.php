<?php

namespace chegamos\entity\container;
use chegamos\entity\Utility;

class UtilityList extends ItemList
{
    private $utilities = array();

    public function add(Utility $utility)
    {
        $this->utilities[] = $utility;
    }

    public function getItems()
    {
        return $this->utilities;
    }
}