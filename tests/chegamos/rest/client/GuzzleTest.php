<?php

namespace chegamos\rest\client;

use chegamos\rest\Request;
use chegamos\rest\auth\BasicAuth;

class GuzzleTest extends \PHPUnit_Framework_TestCase
{
    public function testExecuteRequest()
    {
        $basicAuth = new BasicAuth(
            "MinhaChave",
            "ESecretTbm"
        );

        $guzzle = new Guzzle("http://api.apontador.com.br/v1/");
        $guzzle->setBasicAuth($basicAuth);

        $request = new Request();
        $request->setPath("users/8972911185");
        $request->addQueryItem("type", "json");

        //$guzzle->execute($request);
        //$this->assertEquals("OK", $guzzle->getBody());
    }
}
