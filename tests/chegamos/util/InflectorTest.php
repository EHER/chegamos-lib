<?php

namespace chegamos\util;

class InflectorTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldFormatUnicodeTitles()
    {
        $this->assertEquals(
            'Barão de Tatuí',
            Inflector::formatTitle('barÃo de tatuí')
        );
    }
}
