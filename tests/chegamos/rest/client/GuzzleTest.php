<?php
namespace chegamos\rest\client;

use Guzzle\Http\Message\Response;
use Hamcrest\Core\IsEqual;
use Mockery;
use PHPUnit_Framework_TestCase;
use chegamos\AbstractTestCase;
use chegamos\rest\Request;
use chegamos\rest\auth\BasicAuth;
use chegamos\rest\client\Guzzle;

class GuzzleTest extends PHPUnit_Framework_TestCase
{
    public function testExecuteRequest()
    {
        $guzzleRequestMock = Mockery::mock('GuzzleHttp\Message\RequestInterface');

        $guzzleClientMock = Mockery::mock('GuzzleHttp\Client');
        $guzzleClientMock
            ->shouldReceive('send')
            ->once()
            ->with(new IsEqual($guzzleRequestMock))
            ->andReturn(new Response(200));

        $guzzleClientMock
            ->shouldReceive('createRequest')
            ->once()
            ->with(
                'GET',
                'https://api.apontador.com.br/v2/places/1234',
                [
                    'headers' => [
                        ['Authorization', 'Bearer YOUR_ACCESS_TOKEN']
                    ]
                ]
            )
            ->andReturn($guzzleRequestMock);

        $request = new Request();
        $request->setBaseUrl('https://api.apontador.com.br/v2/');
        $request->setPath('places/1234');
        $request->setHeader([['Authorization', 'Bearer YOUR_ACCESS_TOKEN']]);

        $guzzle = new Guzzle($guzzleClientMock);
        $guzzle->execute($request);
    }
}
