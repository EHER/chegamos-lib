<?php

namespace chegamos\entity;

use chegamos\rest\auth\BasicAuth;
use chegamos\rest\auth\OAuth;
use chegamos\rest\client\Client;

class Config
{
    private $basicAuth;
    private $oAuth;
    private $restClient;
    private $baseUrl;

    public function setBasicAuth(BasicAuth $basicAuth)
    {
        $this->basicAuth = $basicAuth;
    }

    public function getBasicAuth()
    {
        return $this->basicAuth;
    }

    public function setOAuth(OAuth $oAuth)
    {
        $this->oAuth = $oAuth;
    }

    public function getOAuth()
    {
        return $this->oAuth;
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
