<?php

namespace chegamos\entity;

class Utility
{
    private $partnerToken;
    private $endPointUrl;
    private $type;

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setPartnerToken($token)
    {
        $this->partnerToken = $token;
        return $this;
    }

    public function getPartnerToken()
    {
        return $this->partnerToken;
    }

    public function setEndPointUrl($url)
    {
        $this->endPointUrl = $url;
        return $this;
    }

    public function getEndPointUrl()
    {
        return $this->endPointUrl;
    }
}