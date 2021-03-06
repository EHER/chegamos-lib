<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\User;
use chegamos\entity\UserStats;
use chegamos\entity\Place;
use chegamos\entity\container\PlaceList;

class UserFactory
{
    public static function generate($userJsonObject)
    {
        if (is_object($userJsonObject)) {
            $isFullUser = isset($userJsonObject->birthday);
            $isUserList = isset($userJsonObject->stats);
            $isReviewList = isset($userJsonObject->reviews);
            $isPlaceList = isset($userJsonObject->places);
            $isPhotoList = isset($userJsonObject->photos);

            $user = new User();

            $user->setId($userJsonObject->id);
            $user->setName($userJsonObject->name);

            $user->setPhotoMediumUrl($userJsonObject->photo_medium_url);
            $user->setPhotoUrl($userJsonObject->photo_url);
            $user->setPhotoSmallUrl($userJsonObject->photo_small_url);

            //$user->setPhotoMediumUrl($userJsonObject->photo_medium);
            //$user->setPhotoUrl($userJsonObject->photo);
            //$user->setPhotoSmallUrl($userJsonObject->photo_small);

            if ($isFullUser) {
                $user->setBirthday($userJsonObject->birthday);
                $user->setGender($userJsonObject->gender);
                $user->setStats(new UserStats($userJsonObject->stats));
            }

            if ($isUserList) {
                $user->setStats(new UserStats($userJsonObject->stats));
            }

            if ($isReviewList) {
                $user->setReviews(ReviewListFactory::generate($userJsonObject));
            }

            if ($isPlaceList) {
                $user->setPlaces(new PlaceList($userJsonObject));
            }

            if ($isPhotoList) {
                $user->setPhotos(new PhotoList($userJsonObject));
            }

            if (isset($userJsonObject->last_visit->place)) {
                $user->setLastVisit(
                    new Place($userJsonObject->last_visit->place)
                );
            } else {
                $user->setLastVisit(new Place());
            }

            return $user;
        } else {
            throw new ChegamosException("Parâmetro data não é um objeto.");
        }
    }
}
