<?php

namespace chegamos\entity;

class PhoneTest extends \PHPUnit_Framework_TestCase
{
    private $phone;

    protected function setUp()
    {
        $this->phone = new Phone();
    }

    public function testPhoneToInternationalStandardWithNumberAreaAndCountry()
    {
        $this->phone->setNumber('12345678');
        $this->phone->setArea('11');
        $this->phone->setCountry('55');

        $this->assertEquals('+55 (11) 1234-5678', $this->phone->toInternationalStandard());
    }

    public function testPhoneToInternationalStandardJustWithNumberAndArea()
    {
        $this->phone->setNumber('12345678');
        $this->phone->setArea('11');

        $this->assertEquals('+55 (11) 1234-5678', $this->phone->toInternationalStandard());
    }

    public function testPhoneToInternationalStandardJustWithNumber()
    {
        $this->phone->setNumber('12345678');

        $this->assertEquals('', $this->phone->toInternationalStandard());
    }

    public function testPhoneToBrazilianStandard()
    {
        $this->phone->setNumber('12345678');
        $this->phone->setArea('11');
        $this->phone->setCountry('55');

        $this->assertEquals('(11) 1234-5678', $this->phone->toBrazilianStandard());
    }
}
