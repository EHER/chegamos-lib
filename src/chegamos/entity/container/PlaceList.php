<?php

namespace chegamos\entity\container;

class PlaceList extends ItemsList
{
    private $radius;
    private $facets;

    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    public function getRadius()
    {
        return $this->radius;
    }

    public function setFacets($facets)
    {
        $this->facets = $facets;
    }

    public function getFacets()
    {
        return $this->facets;
    }

    public function addUnique($newItem)
    {
        $isUnique = true;

        foreach ($this->getItems() as $item) {
            if ($newItem->getId() == $item->getId()) {
                $isUnique = false;
                break;
            }
        }

        if ($isUnique) {
            $this->add($newItem);
            $this->setNumFound($this->getNumFound() + 1);
        }
    }
}
