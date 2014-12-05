<?php

namespace chegamos\rest\auth;

class BasicAuthTest extends \PHPUnit_Framework_TestCase
{
    public function testGetHeader()
    {
        $basicAuth = new BasicAuth("User", "Pass");
        $this->assertEquals(
            array("Authorization", "Basic VXNlcjpQYXNz"),
            $basicAuth->getHeader()
        );
    }

    public function testGetHeaderWithoutPassword()
    {
        $basicAuth = new BasicAuth("User", "");
        $this->assertEquals(
            null,
            $basicAuth->getHeader()
        );
    }

    public function testGetHeaderWithoutUser()
    {
        $basicAuth = new BasicAuth("", "Pass");
        $this->assertEquals(
            null,
            $basicAuth->getHeader()
        );
    }
}
