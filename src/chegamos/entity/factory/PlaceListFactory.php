<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\container\PlaceList;

class PlaceListFactory
{
    public static function fromJson($placeListJson)
    {
        $placeListObject = json_decode($placeListJson);

        if (!is_object($placeListObject)) {
            throw new ChegamosException("Parâmetro passado não é um objeto.");
        }

        $placeList = new PlaceList();
        $placeList->setNumFound($placeListObject->results->header->found);
        $placeList->setCurrentPage($placeListObject->results->header->found / $placeListObject->results->header->rows);

        foreach ($placeListObject->results->places as $place) {
            $placeList->add(PlaceFactory::fromStdClass($place));
        }

        if (isset($placeListObject->facets)) {
            $placeList->setFacets(
                FacetsFactory::generate($placeListObject->facets)
            );
        }

        return $placeList;
    }
}
