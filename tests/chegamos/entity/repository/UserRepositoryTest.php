<?php

namespace chegamos\entity\repository;

use chegamos\rest\Guzzle;

class UserRepositoryTest extends \PHPUnit_Framework_TestCase
{
    private $userRepository;

    protected function Setup()
    {
        $userJsonString = <<<JSON
{"user":{
	"id":"8972911185",
	"name":"Eher",
	"birthday":"1983-07-02",
	"gender":"M",
	"privileges":"0",
	"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
	"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
	"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
	"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg",
	"stats":{
		"places":"61",
		"photos":"263",
		"reviews":"104",
		"visits":"1,152"
		}
	}	
}
JSON;

        $restClient = $this->getMock('Guzzle', array('get'));
        $restClient->expects($this->any())
            ->method('get')
            ->will($this->returnValue($userJsonString));

        $this->userRepository = new UserRepository($restClient);
    }

    protected function TearDown()
    {
        unset($this->UserRepository);
    }

    public function testGetUserById()
    {
        $user = $this->userRepository->get("8972911185");
        $this->assertEquals("8972911185", $user->getId());
        $this->assertEquals("Eher", $user->getName());
        $this->assertEquals("02/07/83", $user->getBirthday());
        $this->assertEquals("Masculino", $user->getGender());
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg", 
            $user->getPhotoUrl()
        );
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg", 
            $user->getPhotoMediumUrl()
        );
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg", 
            $user->getPhotoSmallUrl()
        );
        $this->assertEquals("61", $user->getStats()->getPlaces());
        $this->assertEquals("263", $user->getStats()->getPhotos());
        $this->assertEquals("104", $user->getStats()->getReviews());
    }

    public function testGetUserWithReviewsById()
    {
        $user = $this->userRepository
            ->withReviews()
            ->get("8972911185");
        $this->assertEquals("8972911185", $user->getId());
        $this->assertEquals("Eher", $user->getName());
        $this->assertEquals("02/07/83", $user->getBirthday());
        $this->assertEquals("Masculino", $user->getGender());
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg", 
            $user->getPhotoUrl()
        );
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg", 
            $user->getPhotoMediumUrl()
        );
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg", 
            $user->getPhotoSmallUrl()
        );
        $this->assertEquals("61", $user->getStats()->getPlaces());
        $this->assertEquals("263", $user->getStats()->getPhotos());
        $this->assertEquals("104", $user->getStats()->getReviews());
    }
}
