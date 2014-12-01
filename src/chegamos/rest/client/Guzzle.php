<?php
namespace chegamos\rest\client;

use Guzzle\Http\Client as GuzzleClient ;
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
        if ($request->getVerb() === 'GET') {
            $guzzleRequest = $this->client->get($request->getUrlWithQueryString());
        }

        if ($request->getHeader()) {
            list ($headerName, $headerValue) = $request->getHeader();
            $guzzleRequest = $this->client->setHeader($headerName, $headerValue);
        }

        $this->response = $this->client->send($guzzleRequest);

        return $this->getBody();
    }

    public function getBody()
    {
        return (string) $this->response->getBody();
    }
}
