<?php

namespace chegamos\entity\container;

class ItemsIterator extends \ArrayIterator
{
    protected $items = array();

    public function __construct(ItemsList $list)
    {
        $this->items = $list->getItems();
    }

    public function rewind()
    {
        reset($this->items);
    }

    public function current()
    {
        return current($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function valid()
    {
        return $this->current() !== false;
    }

    public function next()
    {
        return next($this->items);
    }

    public function count()
    {
        return count($this->items);
    }

    public function setItems(array $items)
    {
        $this->items = $items;
    }

    public function getArrayCopy()
    {
        return $this->items;
    }

    public function offsetExists($index)
    {
        return isset($this->items[$index]);
    }

    public function offsetGet($index)
    {
        if ($this->offsetExists($index)) {
            return $this->items[$index];
        }
    }

    public function offsetSet($index, $value)
    {
        $this->items[$index] = $value;
    }

    public function offsetUnset($index)
    {
        unset($this->items[$index]);
    }
}
