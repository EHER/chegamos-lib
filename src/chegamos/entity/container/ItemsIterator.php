<?php

namespace chegamos\entity\container;

class ItemsIterator implements \Iterator, \Countable
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


}