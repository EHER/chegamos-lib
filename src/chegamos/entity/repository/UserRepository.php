<?php

namespace chegamos\entity\repository;

use chegamos\entity\factory\UserFactory;

class UserRepository
{
    private $restClient;

    public function __construct($restClient)
    {
        $this->restClient = $restClient;
    }

    public function get($userId)
    {
        $userJsonString = $this->restClient->get("users/" . $userId . '?type=json');
        $userJsonObject = json_decode($userJsonString);
        return UserFactory::generate($userJsonObject->user);
    }

    public function getWithReviews($userId)
    {
        $userJsonString = $this->restClient->get(
            "users/" . $userId . '/reviews?type=json'
        );
        $userJsonObject = json_decode($userJsonString);
        return UserFactory::generate($userJsonObject->user);
    }
}
