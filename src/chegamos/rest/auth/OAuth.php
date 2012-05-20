<?php

namespace chegamos\rest\auth;

use Eher\OAuth\Consumer;
use Eher\OAuth\Token;

class OAuth
{
    private $consumer;
    private $requestToken;
    private $token;

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

    public function setToken(Token $token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $token;
    }

    public function generateSignature($verb, $url, $params)
    {
        $baseString = $this->generateSignatureBaseString($verb, $url, $params);
        $signatureKey = $this->generateSignatureKey();
        $octetString = hash_hmac('sha1', $baseString, $signatureKey, true);
        return base64_encode($octetString);
    }

    public function generateSignatureBaseString($verb, $url, $params)
    {
        ksort($params);
        $baseString  = strtoupper($verb);
        $baseString .= "&";
        $baseString .= $this->urlencode_rfc3986($url);
        $baseString .= "&";
        $baseString .= $this->http_build_query_rfc3986($params);

        return $baseString;
    }

    public function generateSignatureKey()
    {
        $keyParts = array(
            $this->consumer->secret,
            ($this->token) ? $this->token->secret : ""
        );

        $keyParts = $this->urlencode_rfc3986($keyParts);
        $signatureKey = implode('&', $keyParts);

        return $signatureKey;
    }

    public function urlencode_rfc3986($input) {
        if (is_array($input)) {
            return array_map(array('Chegamos\rest\auth\OAuth', 'urlencode_rfc3986'), $input);
        } else if (is_scalar($input)) {
            return str_replace(
                '+',
                ' ',
                str_replace('%7E', '~', rawurlencode($input))
            );
        } else {
            return '';
        }
    }

    private function http_build_query_rfc3986($queryData)
    {
        $queryArray = array();
        foreach($queryData as $key => $value) {
            $queryArray[] = $key . "=" . $value;
        }
        $queryString = join('&', $queryArray);
        return $this->urlencode_rfc3986($queryString);
    }
}
