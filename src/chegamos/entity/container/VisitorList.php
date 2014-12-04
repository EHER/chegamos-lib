<?php

namespace chegamos\entity\container;

class VisitorList extends ItemsList
{
    public $placeId = '';

    public function __construct($data = null)
    {
        if (!empty($data)) {
            $this->setNumFound(count($data));
            foreach ($data as $visitor) {
                $this->add(new Visitor($visitor->visitor));
            }
        }
    }

    public function getPlaceId()
    {
        return $this->placeId;
    }

    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
    }
}
