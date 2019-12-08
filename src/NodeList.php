<?php
namespace Gt\Dom;

use DOMNodeList;
use ArrayAccess;
use Countable;
use Iterator;

/**
 * @property-read int $length
 */
class NodeList implements Iterator, ArrayAccess, Countable {
	use LiveProperty;

	protected $list;
	protected $iteratorKey;

	public function __construct(DOMNodeList $domNodeList) {
		$this->list = $domNodeList;
	}

	/**
	 * Returns the number of Nodes contained in this Collection. On the
	 * NodeList class this counts all types of Node object,
	 * not just Elements.
	 * @return int Number of Elements
	 */
	protected function prop_get_length():int {
		return $this->list->length;
	}

	/**
	 * Gets the nth Element object in the internal DOMNodeList.
	 * @param int $index
	 * @return Element|null
	 */
	public function item(int $index):?Element {
		/** @noinspection PhpIncompatibleReturnTypeInspection */
		return $this->list->item($index) ?? null;
	}

// Iterator --------------------------------------------------------------------

	public function rewind():void {
		$this->iteratorKey = 0;
	}

	public function key():int {
		return $this->iteratorKey;
	}

	public function valid():bool {
		return isset($this->list[$this->key()]);
	}

	public function next():void {
		$this->iteratorKey++;
	}

	/** @return Node|null */
	public function current() {
		return $this->list[$this->key()] ?? null;
	}

// ArrayAccess -----------------------------------------------------------------
	public function offsetExists($offset):bool {
		return isset($offset, $this->list);
	}

	public function offsetGet($offset):?Element {
		return $this->item($offset);
	}

	public function offsetSet($offset, $value):void {
		throw new \BadMethodCallException("NodeList's items are read only");
	}

	public function offsetUnset($offset):void {
		throw new \BadMethodCallException("NodeList's items are read only");
	}

// Countable -------------------------------------------------------------------
	public function count():int {
		return $this->length;
	}
}