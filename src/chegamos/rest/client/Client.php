<?php

namespace chegamos\rest\client;

use chegamos\rest\Request;
use chegamos\rest\auth\BasicAuth;
use chegamos\rest\auth\OAuth;

abstract class Client
{
    private $basicAuth;
    private $oAuth;

    public abstract function __construct($url);
    public abstract function getBody();
    public abstract function execute(Request $request);

    public final function setBasicAuth(BasicAuth $basicAuth)
    {
        $this->basicAuth = $basicAuth;
    }

    public final function getBasicAuth()
    {
        return $this->basicAuth;
    }

    public final function setOAuth(OAuth $oAuth)
    {
        $this->oAuth = $oAuth;
    }

    public final function getOAuth()
    {
        return $this->oAuth;
    }
}

