<?php

namespace chegamos\entity\container;
use chegamos\entity\Utility;
use chegamos\entity\container\ItemsList;

class UtilityList extends ItemsList
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