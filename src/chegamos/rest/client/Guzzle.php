<?php
namespace chegamos\rest\client;

use GuzzleHttp\Client as GuzzleClient ;
use chegamos\rest\Request;

class Guzzle extends Client
{
    private $client;
    private $response;

    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    public function execute(Request $request)
    {
        $guzzleRequest = $this->client->createRequest(
            $request->getVerb(),
            $request->getUrlWithQueryString(),
            [
                'headers' => $request->getHeader()
            ]
        );

        $this->response = $this->client->send($guzzleRequest);

        return $this->getBody();
    }

    public function getBody()
    {
        return (string) $this->response->getBody();
    }
}
