<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\Photo;

class PhotoFactory
{
    public static function generate($photoJsonObject)
    {
        if (is_object($photoJsonObject)) {
            $photo = new Photo();

            $photo->setSmallUrl($photoJsonObject->small_url);
            $photo->setMediumUrl($photoJsonObject->medium_url);
            $photo->setLargeUrl($photoJsonObject->large_url);
            $photo->setCreated(
                new \DateTime($photoJsonObject->created->timestamp)
            );
            $photo->setAuthor(
                UserFactory::generate($photoJsonObject->created->user)
            );

            return $photo;
        } else {
            throw new ChegamosException("Parâmetro passado não é um objeto.");
        }
    }
}
