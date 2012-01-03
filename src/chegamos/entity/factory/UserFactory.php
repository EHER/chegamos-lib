<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\User;
use chegamos\entity\UserStats;
use chegamos\entity\Place;
use chegamos\entity\container\PlaceList;
use chegamos\entity\container\ReviewList;

class UserFactory
{
    public static function generate($userJsonObject)
    {
        if (is_object($userJsonObject)) {
            $user = new User;

            $user->setId($userJsonObject->id);
            $user->setName($userJsonObject->name);
            $user->setBirthday($userJsonObject->birthday);
            $user->setGender($userJsonObject->gender);

            if (isset($userJsonObject->photo_medium_url)) {
                $user->setPhotoMediumUrl($userJsonObject->photo_medium_url);
            } else if (isset($userJsonObject->photo_medium)) {
                $user->setPhotoMediumUrl($userJsonObject->photo_medium);
            }

            if (isset($userJsonObject->photo_url)) {
                $user->setPhotoUrl($userJsonObject->photo_url);
            } else if (isset($userJsonObject->photo)) {
                $user->setPhotoUrl($userJsonObject->photo);
            }

            if (isset($userJsonObject->photo_small_url)) {
                $user->setPhotoSmallUrl($userJsonObject->photo_small_url);
            } else if (isset($userJsonObject->photo_small)) {
                $user->setPhotoSmallUrl($userJsonObject->photo_small);
            }

            if (isset($userJsonObject->places)) {
                $user->setPlaces(new PlaceList($userJsonObject));
            }

            if (isset($userJsonObject->reviews)) {
                $user->setReviews(new ReviewList($userJsonObject));
            }

            if (isset($userJsonObject->photos)) {
                $user->setPhotos(new PhotoList($userJsonObject));
            }

            if (isset($userJsonObject->last_visit->place)) {
                $user->setLastVisit(
                    new Place($userJsonObject->last_visit->place)
                );
            } else {
                $user->setLastVisit(new Place());
            }

            $user->setStats(new UserStats($userJsonObject->stats));

            return $user;
        } else {
            throw new ChegamosException("Parâmetro data não é um objeto.");
        }
    }
}
