<?php

namespace chegamos\entity\repository;

use chegamos\entity\factory\UserFactory;

class UserRepository
{
    private $restClient;
    private $requestType;
    private $query;

    public function __construct($restClient)
    {
        $this->restClient = $restClient;
        $this->requestType = "details";
        $this->query['type'] = 'json';
    }

    public function get($userId)
    {
        $userJsonString = $this->restClient->get(
            $this->getPath($userId) . '?' . $this->getQueryString()
        );

        $userJsonObject = json_decode($userJsonString);
        return UserFactory::generate($userJsonObject->user);
    }

    public function withDetails()
    {
        $this->query['requestType'] = 'details';
        return $this;
    }

    public function withReviews()
    {
        $this->query['requestType'] = 'reviews';
        return $this;
    }

    public function page($page)
    {
        $this->query['page'] = $page;
        return $this;
    }

    private function getQueryString()
    {
        return http_build_query($this->query);
    }

    private function getPath($userId)
    {
        switch ($this->requestType) {
        case 'details':
            $path = "users/" . $userId;
            break;
        case 'reviews':
            $path = "users/" . $userId . '/reviews';
            break;
        }
        return $path;
    }
}
