<?php

namespace chegamos\rest;

class Request
{
    private $verb = 'GET';
    private $baseUrl;
    private $path;
    private $query = array();
    private $param = array();
    private $header;

    public function setVerb($verb)
    {
        $this->verb = $verb;
    }

    public function getVerb()
    {
        return $this->verb;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function addQueryItem($key, $value)
    {
        $this->query[$key] = $value;
    }

    public function getQueryItem($key)
    {
        return $this->query[$key];
    }

    public function getQueryString()
    {
        return http_build_query($this->query);
    }

    public function addParam($key, $value)
    {
        $this->param[$key] = $value;
    }

    public function getParam($key)
    {
        return $this->param[$key];
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function getUrlWithQueryString()
    {
        $url = $this->getBaseUrl() . $this->getPath();
        $queryString = $this->getQueryString();

        return empty($queryString) ? $url : $url . '?' . $queryString;
    }
}
