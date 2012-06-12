<?php

namespace chegamos\rest\auth;

use Eher\OAuth\Token;

class OAuthTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateSignatureBaseString()
    {
        $oAuth = new OAuth("Key", "Secret");
        $oAuth->setToken(new Token("Token", "TokenSecret"));

        $expectedSignatureBaseString = "GET&http%3A%2F%2Fphotos.example.net%2Fphotos&file%3Dvacation.jpg%26oauth_consumer_key%3DKey%26oauth_nonce%3Dkllo9940pd9333jh%26oauth_signature_method%3DHMAC-SHA1%26oauth_timestamp%3D1191242096%26oauth_token%3DToken%26oauth_version%3D1.0%26size%3Doriginal";
        $this->assertEquals(
            $expectedSignatureBaseString,
            $oAuth->generateSignatureBaseString(
                "GET",
                "http://photos.example.net/photos",
                array(
                    "file" => "vacation.jpg",
                    "oauth_consumer_key" => "Key",
                    "oauth_nonce" => "kllo9940pd9333jh",
                    "oauth_signature_method" => "HMAC-SHA1",
                    "oauth_timestamp" => "1191242096",
                    "oauth_token" => "Token",
                    "oauth_version" => "1.0",
                    "size" => "original",
                )
            )
        );
    }

    public function testGenerateSignatureKey()
    {
        $oAuth = new OAuth("Key", "Secret");
        $oAuth->setToken(new Token("Token", "TokenSecret"));

        $expectedSignatureKey = "Secret&TokenSecret";
        $this->assertEquals(
            $expectedSignatureKey,
            $oAuth->generateSignatureKey(
                "GET",
                "http://photos.example.net/photos",
                array(
                    "file" => "vacation.jpg",
                    "oauth_consumer_key" => "Key",
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
        $oAuth->setToken(new Token("Token", "TokenSecret"));

        $expectedSignature = "6xiP+J+zZAaotb4rpblXKxrHUy4=";
        $this->assertEquals(
            $expectedSignature,
            $oAuth->generateSignature(
                "GET",
                "http://photos.example.net/photos",
                array(
                    "file" => "vacation.jpg",
                    "oauth_consumer_key" => "Key",
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

