<?php

namespace chegamos\rest\client;

use chegamos\rest\Request;
use chegamos\exception\ChegamosRestException;

class Curl extends Client
{
    private $response;
    private $curl;

    public function execute(Request $request)
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_URL, $request->getUrlWithQueryString());
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $request->getVerb());
        if ($request->getHeader()) {
            list ($headerName, $headerValue) = $request->getHeader();
            curl_setopt(
                $this->curl,
                CURLOPT_HTTPHEADER,
                array($headerName . ": "  . $headerValue)
            );
        }
        $this->response = curl_exec($this->curl);
        $this->validateResponse();
        curl_close($this->curl);
        return $this->getBody();
    }

    public function getBody()
    {
        return (string) $this->response;
    }

    private function validateResponse()
    {
        $info = curl_getinfo($this->curl);
        if ($info['http_code'] < 200 || $info['http_code'] >= 300) {
            curl_close($this->curl);
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
