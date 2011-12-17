<?php

namespace chegamos\entity\factory;

use chegamos\entity\Place;
use chegamos\entity\Category;
use chegamos\entity\Address;
use chegamos\entity\Point;
use chegamos\entity\PlaceInfo;
use chegamos\util\Inflector;
use chegamos\exception\ChegamosException;

class PlaceFactory 
{
    public static function generate($data) 
    {
        if(is_object($data)) {
            $place = new Place();

            $place->setId($data->id);
            $place->setName($data->name);
            $place->setAverageRating($data->average_rating);
            $place->setReviewCount($data->review_count);
            $place->setCategory(new Category($data->category));
            $place->setSubcategory(new Category($data->subcategory));
            $place->setAddress(new Address($data->address));
            $place->setPoint(new Point($data->point));
            $place->setMainUrl($data->main_url);
            $place->setOtherUrl($data->other_url);
            $place->setIconUrl($data->icon_url);
            $place->setDescription($data->description);
            $place->setCreated($data->created);
            $place->setPhone($data->phone);
            $place->setPlaceInfo(new PlaceInfo($data->extended));
            $place->setNumVisitors($data->num_visitors);
            $place->setNumPhotos($data->num_photos);

            return $place;
        } else {
            throw new ChegamosException("Parâmetro data não é um objeto.");
        }
    }
}