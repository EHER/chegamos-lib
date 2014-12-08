<?php

namespace chegamos\rest\auth;

class AccessToken
{
    private $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getHeader()
    {
        return array("Authorization", "Bearer ".$this->accessToken);
    }
}
