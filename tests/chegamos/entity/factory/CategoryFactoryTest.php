<?php

namespace chegamos\entity\factory;

use chegamos\entity\Category;
use chegamos\exception\ChegamosException;

class CategoryFactoryTest extends \PHPUnit_Framework_TestCase 
{

    protected $category;

    protected function setUp() 
    {
        $this->category = new Category;
    }

    protected function tearDown() 
    {
        unset($this->category);
    }

    public function testGenerate() 
    {
        $data = new \stdClass;
        $data->id = 123;
        $data->name = "Restaurantes";
        $data->subcategory = new \stdClass;
        $data->subcategory->id = 321;
        $data->subcategory->name = "Fastfood";

        $category = CategoryFactory::generate($data);

        $this->assertEquals(123, $category->getId());
        $this->assertEquals("Restaurantes", $category->getName());
        $this->assertEquals("Fastfood", $category->getSubcategory());
        $this->assertEquals(321, $category->getSubcategory()->getId());
        $this->assertEquals("Fastfood", $category->getSubcategory()->getName());
    }

    public function testGenerateWithoutData() 
    {
        try {
            CategoryFactory::generate(null);
        } catch(ChegamosException $e) {
            $this->assertEquals("Parâmetro data não é um objeto.", $e->getMessage());
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }
}
