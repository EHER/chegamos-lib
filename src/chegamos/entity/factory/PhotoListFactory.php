<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\container\PhotoList;

class PhotoListFactory
{
    public static function generate($photoListJsonObject)
    {
        if (is_object($photoListJsonObject)) {
            $photoList = new PhotoList();
            foreach ($photoListJsonObject->photo_info as $photo) {
                $photoList->add(PhotoFactory::generate($photo));
            }
            return $photoList;
        } else {
            throw new ChegamosException("Parâmetro passado não é um objeto.");
        }
    }
}
