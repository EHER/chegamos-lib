<?php

namespace chegamos\entity\container;
use chegamos\entity\Utility;
use chegamos\entity\container\ItemsList;

class UtilityList extends ItemsList
{
    private $utilities = array();

    public function add($utility)
    {
    	if (!$utility instanceof Utility) {
    		throw new \InvalidArgumentException(
    			'to add an utility it must be instance of chegamos\entity\Utility'
			);
    	}
        $this->utilities[] = $utility;
    }

    public function getItems()
    {
        return $this->utilities;
    }
}