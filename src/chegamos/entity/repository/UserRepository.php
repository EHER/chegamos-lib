<?php

namespace chegamos\entity\repository;

use chegamos\entity\Config;
use chegamos\entity\factory\UserFactory;
use chegamos\entity\factory\UserListFactory;
use chegamos\rest\Request;

class UserRepository extends AbstractRepository
{
    public function get($id)
    {
        $this->byId($id);

        $userJsonString = $this->config->getRestClient()->execute($this->request);
        $this->resetRequest();

        $userJsonObject = json_decode($userJsonString);

        return UserFactory::generate($userJsonObject->user);
    }

    public function getAll()
    {
        $this->request->setPath('search/users');

        $userListJsonString = $this->config->getRestClient()->execute($this->request);
        $this->resetRequest();

        $userListJsonObject = json_decode($userListJsonString);

        return UserListFactory::generate($userListJsonObject->search);
    }

    public function withDetails()
    {
        $this->request->setPath('users/{id}');

        return $this;
    }

    public function withReviews()
    {
        $this->request->setPath('users/{id}/reviews');

        return $this;
    }

    public function byId($id)
    {
        $this->request->addParam('id', $id);
        $this->request->setPath('users/{id}');

        return $this;
    }

    public function byName($name)
    {
        $this->request->setPath('search/users/byname');
        $this->request->addQueryItem('name', $name);

        return $this;
    }

    public function byEmail($email)
    {
        $this->request->setPath('search/users/byemail');
        $this->request->addQueryItem('email', $email);

        return $this;
    }

    public function page($page)
    {
        $this->request->addQueryItem('page', $page);

        return $this;
    }
}
