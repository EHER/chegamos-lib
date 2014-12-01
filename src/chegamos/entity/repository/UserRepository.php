<?php

namespace chegamos\entity\repository;

use chegamos\entity\Config;
use chegamos\entity\factory\UserFactory;
use chegamos\entity\factory\UserListFactory;
use chegamos\rest\Request;

class UserRepository extends AbstractRepository
{
    private $requestType = 'details';

    public function get($id)
    {
        $this->byId($id);

        $this->getPath();
        $this->request->setVerb('GET');

        $userJsonString = $this->config->getRestClient()->execute($this->request);
        $this->resetRequest();

        $userJsonObject = json_decode($userJsonString);

        return UserFactory::generate($userJsonObject->user);
    }

    public function getAll()
    {
        $this->getPath();
        $this->request->setVerb('GET');

        $userListJsonString = $this->config->getRestClient()->execute($this->request);
        $this->resetRequest();

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
        $this->request->addParam('id', $id);

        return $this;
    }

    public function byName($name)
    {
        $this->requestType = 'usersByName';
        $this->request->addQueryItem("name", $name);

        return $this;
    }

    public function byEmail($email)
    {
        $this->requestType = 'usersByEmail';
        $this->request->addQueryItem("email", $email);

        return $this;
    }

    public function page($page)
    {
        $this->request->addQueryItem("page", $page);

        return $this;
    }

    private function getPath()
    {
        switch ($this->requestType) {
            case 'usersByName':
                $this->request->setPath("search/users/byname");
                break;
            case 'usersByEmail':
                $this->request->setPath("search/users/byemail");
                break;
            case 'details':
                $this->request->setPath("users/" . $this->request->getParam('id'));
                break;
            case 'reviews':
                $this->request->setPath(
                    "users/" . $this->request->getParam('id') . '/reviews'
                );
                break;
        }

        return $this->request->getPath();
    }
}
