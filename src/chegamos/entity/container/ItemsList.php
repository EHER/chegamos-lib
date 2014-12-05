<?php

namespace chegamos\entity\container;

class ItemsList implements \IteratorAggregate
{
    protected $items = array();
    protected $numFound = 0;
    protected $currentPage = 1;

    public function getItem($index = 0)
    {
        $items = $this->getItems();

        return $items[$index];
    }

    public function getNumFound()
    {
        return $this->numFound;
    }

    public function getIterator()
    {
        return new ItemsIterator($this);
    }

    public function setNumFound($numFound)
    {
        $this->numFound = $numFound;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
}
