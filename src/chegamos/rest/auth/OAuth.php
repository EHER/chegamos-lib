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

    public function generateSignatureBaseString($verb, $url, $params)
    {
        ksort($params);
        $baseString  = strtoupper($verb);
        $baseString .= "&";
        $baseString .= rawurlencode($url);
        $baseString .= "&";
        $baseString .= $this->http_build_query_rfc3986($params);

        return $baseString;
    }

    private function http_build_query_rfc3986($queryData)
    {
        $queryArray = array();
        foreach($queryData as $key => $value) {
            $queryArray[] = $key . "=" . $value;
        }
        $queryString = join('&', $queryArray);
        return rawurlencode($queryString);
    }
}
