<?php

namespace chegamos\rest\auth;

use Eher\OAuth\Consumer;

class OAuth
{
    private $consumer;
    private $requestToken;
    private $accessToken;

    public function __construct($key, $secret)
    {
        $this->consumer = new Consumer($key, $secret);
    }

    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;
    }

    public function getConsumer()
    {
        return $this->consumer;
    }

    public function setAccessToken(AccessToken $accessToken)
    {
        $this->AccessToken = $accessToken;
    }

    public function getAccessToken()
    {
        return $accessToken;
    }
}
