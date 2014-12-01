<?php

namespace chegamos\entity;

use chegamos\rest\auth\AccessToken;
use chegamos\rest\client\Client;

class Config
{
    private $accessToken;
    private $restClient;
    private $baseUrl;

    public function setAccessToken(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setRestClient(Client $restClient)
    {
        $this->restClient = $restClient;
    }

    public function getRestClient()
    {
        return $this->restClient;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}
