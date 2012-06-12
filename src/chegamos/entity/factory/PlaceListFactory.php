<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\container\PlaceList;

class PlaceListFactory
{
    public static function generate($placeListJsonObject)
    {
        if (is_object($placeListJsonObject)) {
            $placeList = new PlaceList();
            $placeList->setNumFound($placeListJsonObject->result_count);
            $placeList->setCurrentPage($placeListJsonObject->current_page);
            foreach ($placeListJsonObject->places as $place) {
                $placeList->add(PlaceFactory::generate($place->place));
            }
            
            return $placeList;
        } else {
            throw new ChegamosException("Parâmetro passado não é um objeto.");
        }
    }
}
