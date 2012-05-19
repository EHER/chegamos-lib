<?php

namespace chegamos\rest\auth;

class OAuthTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateSignatreBaseString()
    {
        $oAuth = new OAuth("Key", "Secret");

        $expectedSignatureBaseString = "GET&http%3A%2F%2Fphotos.example.net%2Fphotos&file%3Dvacation.jpg%26oauth_consumer_key%3Ddpf43f3p2l4k3l03%26oauth_nonce%3Dkllo9940pd9333jh%26oauth_signature_method%3DHMAC-SHA1%26oauth_timestamp%3D1191242096%26oauth_token%3Dnnch734d00sl2jdk%26oauth_version%3D1.0%26size%3Doriginal";
        $this->assertEquals(
            $expectedSignatureBaseString,
            $oAuth->generateSignatureBaseString(
                "GET",
                "http://photos.example.net/photos",
                array(
                    "file" => "vacation.jpg",
                    "oauth_consumer_key" => "dpf43f3p2l4k3l03",
                    "oauth_nonce" => "kllo9940pd9333jh",
                    "oauth_signature_method" => "HMAC-SHA1",
                    "oauth_timestamp" => "1191242096",
                    "oauth_token" => "nnch734d00sl2jdk",
                    "oauth_version" => "1.0",
                    "size" => "original",
                )
            )
        );
    }

    public function testGenerateSignature()
    {
        $oAuth = new OAuth("Key", "Secret");

        $expectedSignature = "";
        $this->assertEquals(
            $expectedSignature,
            $oAuth->generateSignature(
                "GET",
                "http://photos.example.net/photos",
                array(
                    "file" => "vacation.jpg",
                    "oauth_consumer_key" => "dpf43f3p2l4k3l03",
                    "oauth_nonce" => "kllo9940pd9333jh",
                    "oauth_signature_method" => "HMAC-SHA1",
                    "oauth_timestamp" => "1191242096",
                    "oauth_token" => "nnch734d00sl2jdk",
                    "oauth_version" => "1.0",
                    "size" => "original",
                )
            )
        );
    }

    public function testGetHeader()
    {
        $oAuth = new OAuth("Key", "Secret");

        $expectedAuthorization = <<<AUTH
OAuth realm="http://api.apontador.com.br/",
oauth_consumer_key="Key",
oauth_token="Token",
oauth_signature_method="HMAC-SHA1",
oauth_signature="tR3%2BTy81lMeYAr%2FFid0kMTYa%2FWM%3D",
oauth_timestamp="1191242096",
oauth_nonce="kllo9940pd9333jh",
oauth_version="1.0"
AUTH;
//        $this->assertEquals(
//            array("Authorization", $expectedAuthorization),
//            $oAuth->getHeader()
//        );
    }
}

