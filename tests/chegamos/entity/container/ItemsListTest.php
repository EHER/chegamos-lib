<?php

namespace chegamos\entity\container;

use chegamos\entity\container\ItemsList;

class ItemsListTest extends \PHPUnit_Framework_TestCase
{

    public function testGetIterator()
    {
        $list = new ItemsList();
        $list->setItems(
            array(
                'John Doe',
                'Frusciante',
                'Foo Bar',
                'Baz Bar',
            )
        );

        $this->assertInstanceOf('chegamos\entity\container\ItemsIterator', $list->getIterator());

        $this->assertCount(4, $list->getIterator());

        $list->add('DuneDue');
        $this->assertCount(5, $list->getIterator());

        $this->assertEquals('Frusciante', $list->getItem(1));
        $this->assertEquals('John Doe', $list->getIterator()->current());
    }
}