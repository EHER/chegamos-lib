<?php

namespace chegamos\rest\auth;

use Eher\OAuth\Consumer;

class OAuth
{
    private $consumer;
    private $access;

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

    public function setAccess(Access $access)
    {
        $this->access = $access;
    }

    public function getAccess()
    {
        return $access;
    }
}
