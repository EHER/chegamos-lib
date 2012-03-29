<?php

namespace chegamos\rest\client;

use chegamos\rest\Request;

class CurlTest extends \PHPUnit_Framework_TestCase
{
    public function testExecuteRequest()
    {
        $curl = new Curl("http://api.apontador.com.br/v1/");
        $request = new Request();
        $request->setPath("users/1234");
        $request->addQueryItem("type", "xml");
        //$curl->execute($request);
        //$response = $curl->getResponse();
    }
}
