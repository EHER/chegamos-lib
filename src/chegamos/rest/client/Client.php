<?php

namespace chegamos\rest\client;

abstract class Client
{
    public abstract function __construct($url);
    public abstract function setAuth($user, $password);
    public abstract function getBody();
    public abstract function get($path);
    public abstract function post($path);
    public abstract function delete($path);
    public abstract function head($path);
    public abstract function put($path);
}

