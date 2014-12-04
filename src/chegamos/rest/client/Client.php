<?php

namespace chegamos\rest\client;

use chegamos\rest\Request;

abstract class Client
{
    abstract public function getBody();

    abstract public function execute(Request $request);
}
