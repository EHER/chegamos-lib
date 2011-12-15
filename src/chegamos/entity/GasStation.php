<?php

namespace chegamos\entity;

use chegamos\util\ItemsList;

class GasStation extends ItemsList {

    public function __construct($data=null) {
        $this->populate($data);
    }

    public function populate($data) {
        if (isset($data) && is_array(new GasStation)) {
            foreach ($data as $itemName => $value) {
                if (strstr($itemName, 'price_') !== false) {
                    $this->add(GasStationItemFactory::generate($itemName, $data));
                }
            }
        }
    }

}
