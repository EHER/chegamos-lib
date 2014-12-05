<?php

namespace chegamos\rest\client;

use Guzzle\Service\Client as GuzzleClient;
use chegamos\rest\Request;

class Guzzle extends Client
{
    private $response;

    public function getBody()
    {
        return (string) $this->response->getBody();
    }

    public function execute(Request $request)
    {
        $guzzle = new GuzzleClient();

        if ($request->getVerb() == 'GET') {
            $guzzleRequest = $guzzle->get($request->getUrlWithQueryString());
        }

        if ($request->getHeader()) {
            list($headerName, $headerValue) = $request->getHeader();
            $guzzleRequest->setHeader($headerName, $headerValue);
        }

        $this->response = $guzzleRequest->send();

        return $this->getBody();
    }
}
