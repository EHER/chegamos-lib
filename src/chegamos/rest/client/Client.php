<?php

namespace chegamos\rest\client;

use chegamos\rest\Request;
use chegamos\rest\auth\BasicAuth;

abstract class Client
{
    private $basicAuth;

    public abstract function __construct($url);
    public abstract function getBody();
    public abstract function execute(Request $request);

    public function setBasicAuth(BasicAuth $basicAuth)
    {
        $this->basicAuth = $basicAuth;
    }

    public function getBasicAuth()
    {
        return $this->basicAuth;
    }

    public function getOAuth()
    {
        return $this->oAuth;
    }
}

