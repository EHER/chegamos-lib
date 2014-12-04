<?php

namespace chegamos\rest\auth;

class BasicAuth
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getHeader()
    {
        if ($this->username && $this->password) {
            $base64 = base64_encode($this->username.":".$this->password);

            return array("Authorization", "Basic ".$base64);
        }
    }
}
