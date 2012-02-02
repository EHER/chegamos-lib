<?php

namespace chegamos\entity\container;

class PlaceList extends ItemsList
{
    private $radius;

    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    public function getRadius()
    {
        return $this->radius;
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
