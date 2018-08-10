<?php
namespace Gt\Dom;

use DOMNodeList;
use ArrayAccess;
use Countable;
use Iterator;

class NodeList implements Iterator, ArrayAccess, Countable {
	use LiveProperty;

	protected $domNodeList;
	protected $iteratorKey;

	public function __construct(DOMNodeList $domNodeList) {
		$this->domNodeList = $domNodeList;
	}

	/**
	 * Returns the number of Elements contained in this Collection. Exposed as the
	 * $length property.
	 * @return int Number of Elements
	 */
	private function prop_get_length():int {
		$key = $this->iteratorKey;

		$length = 0;
		foreach($this as $element) {
			$length++;
		}

		$this->iteratorKey = $key;
		return $length;
	}

	public function getDomNodeList():DOMNodeList {
		return $this->domNodeList;
	}

	/**
	 * Gets the nth Element object in the internal DOMNodeList.
	 * @param int $index
	 * @return Element|null
	 */
	public function item($index) {
		$count = 0;
		foreach($this as $element) {
			if($index === $count) {
				return $element;
			}

			$count++;
		}

		return null;
	}

// Iterator --------------------------------------------------------------------

	public function current():?Element {
		return $this->domNodeList[$this->iteratorKey] ?? null;
	}

	public function key():int {
		return $this->iteratorKey;
	}

	public function next() {
		$this->iteratorKey++;
		$this->incrementKeyToNextElement();
	}

	public function rewind() {
		$this->iteratorKey = 0;
		$this->incrementKeyToNextElement();
	}

	public function valid():bool {
		return isset($this->domNodeList[$this->iteratorKey]);
	}

	private function incrementKeyToNextElement() {
		while($this->valid()
			&& !$this->domNodeList[$this->iteratorKey] instanceof Element) {
			$this->iteratorKey++;
		}
	}

// ArrayAccess -----------------------------------------------------------------
	public function offsetExists($offset):bool {
		return isset($offset, $this->domNodeList);
	}

	public function offsetGet($offset):?Element {
		return $this->item($offset);
	}

	public function offsetSet($offset, $value) {
		return $this->offsetUnset($offset);
	}

	public function offsetUnset($offset) {
		throw new \BadMethodCallException("HTMLCollection's items are read only");
	}

// Countable -------------------------------------------------------------------
	public function count():int {
		return $this->length;
	}
}