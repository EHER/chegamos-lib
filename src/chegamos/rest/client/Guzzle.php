<?php

namespace chegamos\rest\client;

use Guzzle\Service\Client as GuzzleClient ;
use chegamos\rest\Request;

class Guzzle extends Client
{
    private $client;
    private $response;

    public function __construct()
    {
        $this->client = new GuzzleClient();
    }

    public function getBody()
    {
        return (string) $this->response->getBody();
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function execute(Request $request)
    {
        $url = $request->getBaseUrl() . $request->getPath()
            . "?" . $request->getQueryString();

        $this->response = $this->client->get($url);
        $header = $request->getHeader();
        if (is_array($header)) {
            $this->response = $this->response->setHeader($header[0], $header[1]);
        }
        $this->response = $this->response->send();

        return $this->getBody();
    }
}
