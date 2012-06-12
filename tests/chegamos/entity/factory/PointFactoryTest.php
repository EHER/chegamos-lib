<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\Point;

class PointFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
    	$data = new \stdClass();
        $data->lat = "-23.529366";
        $data->lng = "-47.467117";
        
        $point = PointFactory::generate($data);
        $this->assertEquals($data->lat, $point->getLat());
    }
}
