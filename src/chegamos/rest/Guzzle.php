<?php

namespace chegamos\rest;

use Guzzle\Service\Client as GuzzleClient ;

class Guzzle extends Client
{
    private $client;
    private $url;
    private $user;
    private $password;
    private $response;

    public function __construct($url)
    {
        $this->url = $url;
        $this->client = new GuzzleClient($url);
    }

    public function setAuth($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function getBody()
    {
        return (string) $this->response->getBody();
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function get($path)
    {
        $this->response = $this->client
            ->get($path)
            ->setAuth($this->user, $this->password)
            ->send();
        return $this->getBody();
    }

    public function post($path)
    {
        $this->response = $this->client
            ->post($path)
            ->setAuth($this->user, $this->password)
            ->send();
        return $this->getBody();
    }

    public function delete($path)
    {
        $this->response = $this->client
            ->delete($path)
            ->setAuth($this->user, $this->password)
            ->send();
        return $this->getBody();
    }

    public function head($path)
    {
        $this->response = $this->client
            ->head($path)
            ->setAuth($this->user, $this->password)
            ->send();
        return $this->getBody();
    }

    public function put($path)
    {
        $this->response = $this->client
            ->put($path)
            ->setAuth($this->user, $this->password)
            ->send();
        return $this->getBody();
    }
}
