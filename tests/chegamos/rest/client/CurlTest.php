<?php

namespace chegamos\rest\client;

use chegamos\rest\Request;

class CurlTest extends \PHPUnit_Framework_TestCase
{
    public function testExecuteRequest()
    {
        $request = new Request();
        $request->setBaseUrl('https://api.apontador.com.br/v2/');
        $request->setPath('places/1234');

        $curl = new Curl();
        //$curl->execute($request);
    }
}
