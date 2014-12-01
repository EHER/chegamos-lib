<?php
namespace chegamos\rest\client;

use chegamos\rest\Request;
use chegamos\rest\auth\BasicAuth;
use Mockery;
use chegamos\rest\client\Guzzle;
use chegamos\AbstractTestCase;
use PHPUnit_Framework_TestCase;
use Guzzle\Http\Message\Response;
use Hamcrest\Core\IsEqual;

class GuzzleTest extends PHPUnit_Framework_TestCase
{
    public function testExecuteRequest()
    {
        $guzzleClientMock = Mockery::mock('Guzzle\Http\Client');
        $guzzleClientMock
            ->shouldReceive('get')
            ->once()
            ->with('https://api.apontador.com.br/v2/places/1234')
            ->andReturnSelf();
        $guzzleClientMock
            ->shouldReceive('send')
            ->once()
            ->andReturn(new Response(200));

        $request = new Request();
        $request->setBaseUrl('https://api.apontador.com.br/v2/');
        $request->setPath('places/1234');

        $guzzle = new Guzzle($guzzleClientMock);
        $guzzle->execute($request);
    }
}
