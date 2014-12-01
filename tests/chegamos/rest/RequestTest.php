<?php

namespace chegamos\rest;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    protected $request;

    protected function setUp()
    {
        $this->request = new Request();
    }

    protected function tearDown()
    {
        unset($this->request);
    }

    public function testQuery()
    {
        $this->request->addQueryItem("latitude", "-23.25467");
        $this->request->addQueryItem("longitude", "-46.25467");

        $this->assertEquals("-23.25467", $this->request->getQueryItem("latitude"));
        $this->assertEquals("-46.25467", $this->request->getQueryItem("longitude"));
        $this->assertEquals(
            "latitude=-23.25467&longitude=-46.25467",
            $this->request->getQueryString()
        );
    }

    public function testPath()
    {
        $this->request->setPath("/search/places/bypoint");

        $this->assertEquals(
            "/search/places/bypoint",
            $this->request->getPath()
        );
    }

    public function testGetUrlWithQueryString()
    {
        $this->request->setBaseUrl('https://api.apontador.com.br/v2/');
        $this->request->setPath('search');
        $this->request->addQueryItem('q', 'test');

        $this->assertEquals(
            'https://api.apontador.com.br/v2/search?q=test',
            $this->request->getUrlWithQueryString()
        );
    }

    public function testGetUrlWithQueryStringWithoutQueryString()
    {
        $this->request->setBaseUrl('https://api.apontador.com.br/v2/');
        $this->request->setPath('places/1234');

        $this->assertEquals(
            'https://api.apontador.com.br/v2/places/1234',
            $this->request->getUrlWithQueryString()
        );
    }
}
