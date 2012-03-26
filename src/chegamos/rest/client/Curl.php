<?php

namespace chegamos\rest\client;

use chegamos\exception\ChegamosRestException;

class Curl extends Client
{
    private $client;
    private $url;
    private $response;

    public function __construct($url)
    {
        $this->url = $url;
        $this->client = curl_init($this->url);
        curl_setopt($this->client, CURLOPT_RETURNTRANSFER, 1);
    }

    public function setAuth($user, $password)
    {
        curl_setopt($this->client, CURLOPT_USERPWD, $user . ':' . $password);
    }

    public function getBody()
    {
        return (string) $this->response;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function get($path)
    {
        return $this->request($path, 'GET');
    }

    public function post($path)
    {
        return $this->request($path, 'POST');
    }

    public function delete($path)
    {
        return $this->request($path, 'DELETE');
    }

    public function head($path)
    {
        return $this->request($path, 'HEAD');
    }

    public function put($path)
    {
        return $this->request($path, 'PUT');
    }

    private function request($path, $verb='GET')
    {
        curl_setopt($this->client, CURLOPT_URL, $this->url . $path);
        curl_setopt($this->client, CURLOPT_CUSTOMREQUEST, $verb);
        $this->response = curl_exec($this->client);
        $this->validateResponse();
        curl_close($this->client);
        return $this->getBody();
    }

    private function validateResponse()
    {
        $info = curl_getinfo($this->client);
        if ($info['http_code'] < 200 || $info['http_code'] >= 300) {
            curl_close($this->client);
            throw new ChegamosRestException(
                "A chamada retornou HTTP_CODE "
                . $info['http_code']
                . " ao tentar acessar "
                . $info['url']
                . "\r\nConteúdo: "
                . $this->getBody()
            );
        }
    }
}
