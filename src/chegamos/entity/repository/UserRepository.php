<?php

namespace chegamos\entity\repository;

use chegamos\entity\factory\UserFactory;
use chegamos\entity\factory\UserListFactory;

class UserRepository
{
    private $restClient;
    private $requestType;
    private $query;
    private $param;

    public function __construct($restClient)
    {
        $this->restClient = $restClient;
        $this->setup();
    }

    public function get($id = null)
    {
        if (!empty($id)) {
            $this->byId($id);
        }

        $userJsonString = $this->restClient->get(
            $this->getPath() . '?' . $this->getQueryString()
        );
        $this->setup();

        $userJsonObject = json_decode($userJsonString);
        return UserFactory::generate($userJsonObject->user);
    }

    public function getAll()
    {
        $userListJsonString = $this->restClient->get(
            $this->getPath() . '?' . $this->getQueryString()
        );
        $this->setup();

        $userListJsonObject = json_decode($userListJsonString); 
        return UserListFactory::generate($userListJsonObject->search);
    }

    public function withDetails()
    {
        $this->requestType = 'details';
        return $this;
    }

    public function withReviews()
    {
        $this->requestType = 'reviews';
        return $this;
    }

    public function byId($id)
    {
        $this->param['id'] = $id;
        return $this;
    }

    public function byName($name)
    {
        $this->requestType = 'usersByName';
        $this->query['name'] = $name;
        return $this;
    }

    public function byEmail($email)
    {
        $this->requestType = 'usersByEmail';
        $this->query['email'] = $email;
        return $this;
    }

    public function page($page)
    {
        $this->query['page'] = $page;
        return $this;
    }

    private function setup()
    {
        $this->requestType = "details";
        $this->query = array();
        $this->query['type'] = 'json';
        $this->param = array();
    }

    private function getQueryString()
    {
        return http_build_query($this->query);
    }

    private function getPath()
    {
        switch ($this->requestType) {

        case 'usersByName':
            $path = "search/users/byname";
            break;
        case 'usersByEmail':
            $path = "search/users/byemail";
            break;
        case 'details':
            $path = "users/" . $this->param['id'];
            break;
        case 'reviews':
            $path = "users/" . $this->param['id'] . '/reviews';
            break;
        }
        return $path;
    }
}
