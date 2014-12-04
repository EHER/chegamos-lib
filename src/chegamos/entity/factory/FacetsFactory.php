<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\Facet;

class FacetsFactory
{
    public static function generate($jsonObject)
    {
        if (is_array($jsonObject)) {
            $facets = array();

            foreach ($jsonObject as $facetObject) {
                $facet = new Facet($facetObject->name);
                foreach ($facetObject->data as $data) {
                    $facet->add($data->name, $data->count);
                }
                $facets[] = $facet;
            }

            return $facets;
        } else {
            throw new ChegamosException("Parâmetro inválido.");
        }
    }
}
