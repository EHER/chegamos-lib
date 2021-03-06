<?php

namespace chegamos\entity;

class GasStation
{
    public function __construct($data = null)
    {
        $this->populate($data);
    }

    public function populate($data)
    {
        if (isset($data) && is_array(new GasStation())) {
            foreach (array_keys($data) as $itemName) {
                if (strstr($itemName, 'price_') !== false) {
                    $this->add(GasStationItemFactory::generate($itemName, $data));
                }
            }
        }
    }
}
