<?php

namespace chegamos\entity\repository;

use chegamos\entity\Config;
use chegamos\rest\Request;

abstract class AbstractRepository
{
    protected $config;
    protected $request;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->resetRequest();
    }

    protected function resetRequest()
    {
        $this->request = new Request();
        $this->request->setBaseUrl($this->config->getBaseUrl());

        $accessToken = $this->config->getAccessToken();
        if (!empty($accessToken)) {
            $this->request->setHeader($accessToken->getHeader());
        }
    }
}
