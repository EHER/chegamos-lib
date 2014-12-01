<?php

namespace chegamos\entity\repository;

use Mockery;
use PHPUnit_Framework_TestCase;
use chegamos\entity\Config;
use chegamos\rest\auth\AccessToken;
use chegamos\rest\auth\BasicAuth;

class UserRepositoryTest extends PHPUnit_Framework_TestCase
{
    private $userRepository;

    protected function setUp()
    {
        $restClient = Mockery::mock('chegamos\rest\client\Guzzle');
        $restClient
            ->shouldReceive('execute')
            ->once()
            ->andReturn($this->loadJsonFor('user'));

        $config = new Config();
        $config->setAccessToken(new AccessToken('MyAccessToken'));
        $config->setRestClient($restClient);
        $config->setBaseUrl('https://api.apontador.com.br/v2/');

        $this->userRepository = new UserRepository($config);
    }

    protected function tearDown()
    {
        unset($this->UserRepository);
    }

    public function testGetUserById()
    {
        $user = $this->userRepository->get('8972911185');
        $this->assertEquals('8972911185', $user->getId());
        $this->assertEquals('Eher', $user->getName());
        $this->assertEquals('02/07/83', $user->getBirthday());
        $this->assertEquals('Masculino', $user->getGender());
        $this->assertEquals(
            'http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg',
            $user->getPhotoUrl()
        );
        $this->assertEquals(
            'http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg',
            $user->getPhotoMediumUrl()
        );
        $this->assertEquals(
            'http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg',
            $user->getPhotoSmallUrl()
        );
        $this->assertEquals('61', $user->getStats()->getPlaces());
        $this->assertEquals('263', $user->getStats()->getPhotos());
        $this->assertEquals('104', $user->getStats()->getReviews());
    }

    public function testGetUserWithReviewsById()
    {
        $user = $this->userRepository
            ->withReviews()
            ->get('8972911185');
        $this->assertEquals('8972911185', $user->getId());
        $this->assertEquals('Eher', $user->getName());
        $this->assertEquals('02/07/83', $user->getBirthday());
        $this->assertEquals('Masculino', $user->getGender());
        $this->assertEquals(
            'http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg',
            $user->getPhotoUrl()
        );
        $this->assertEquals(
            'http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg',
            $user->getPhotoMediumUrl()
        );
        $this->assertEquals(
            'http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg',
            $user->getPhotoSmallUrl()
        );
        $this->assertEquals('61', $user->getStats()->getPlaces());
        $this->assertEquals('263', $user->getStats()->getPhotos());
        $this->assertEquals('104', $user->getStats()->getReviews());
    }

    private function loadJsonFor($fileName)
    {
        return file_get_contents(__DIR__ . '/../../../fixtures/' . $fileName . '.json');
    }
}
