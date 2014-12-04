<?php

namespace chegamos\rest\client;

use chegamos\rest\Request;
use chegamos\rest\auth\BasicAuth;

abstract class Client
{
    private $basicAuth;

    abstract public function getBody();
    abstract public function execute(Request $request);

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
