<?php

namespace chegamos\rest\client;

use chegamos\rest\Request;
use chegamos\exception\ChegamosRestException;

class Curl extends Client
{
    private $client;
    private $url;
    private $request;
    private $response;

    public function __construct($url)
    {
        $this->request = new Request();
        $this->request->setBaseUrl($url);

        $this->url = $url;
        $this->client = curl_init($this->url);
        curl_setopt($this->client, CURLOPT_RETURNTRANSFER, 1);
    }

    public function execute(Request $request)
    {
        curl_setopt($this->client, CURLOPT_URL, $this->request->getBaseUrl() . $request->getPath());
        curl_setopt($this->client, CURLOPT_CUSTOMREQUEST, $request->getVerb());
        $basicAuth = $this->basicAuth;
        if (!empty($basicAuth)) {
            $user = $this->basicAuth->getUsername();
            $password = $this->basicAuth->getPassword();
            curl_setopt($this->client, CURLOPT_USERPWD, $user . ':' . $password);
        }
        $this->response = curl_exec($this->client);
        $this->validateResponse();
        curl_close($this->client);
        return $this->getBody();
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
        $request = new Request();
        $request->setVerb("GET");
        $request->setPath($path);
        return $this->execute($request);
    }

    public function post($path)
    {
        $request = new Request();
        $request->setVerb("POST");
        $request->setPath($path);
        return $this->execute($request);
    }

    public function delete($path)
    {
        $request = new Request();
        $request->setVerb("DELETE");
        $request->setPath($path);
        return $this->execute($request);
    }

    public function head($path)
    {
        $request = new Request();
        $request->setVerb("HEAD");
        $request->setPath($path);
        return $this->execute($request);
    }

    public function put($path)
    {
        $request = new Request();
        $request->setVerb("PUT");
        $request->setPath($path);
        return $this->execute($request);
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
