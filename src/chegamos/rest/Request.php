<?php

namespace chegamos\rest;

class Request
{
    private $path;
    private $query = array(); 

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
}
