<?php
namespace phpgt\dom;

use Iterator;
use ArrayAccess;
use Countable;
use DOMNodeList;

/**
 * Represents a Node list that can only contain Element nodes. Internally,
 * a DOMNodeList is used to store the association to the original list of
 * Nodes. The Iterator interface is used to handle the selection of Nodes
 * that are Elements.
 *
 * @property-read int $length Number of Element nodes in this collection
 */
class HTMLCollection implements Iterator, ArrayAccess, Countable {
use LiveProperty;

private $domNodeList;
private $key = 0;

public function __construct(DOMNodeList $domNodeList) {
	$this->domNodeList = $domNodeList;
}

/**
 * Gets the nth Element object in the internal DOMNodeList.
 *
 * @param int $index
 * @return Element|null
 */
public function item(int $index) {
	$count = 0;
	foreach($this as $element) {
		if($index === $count) {
			return $element;
		}

		$count++;
	}

	return null;
}

/**
 * @param string $name Returns the specific Node whose ID or, as a fallback,
 * name matches the string specified by $name. Matching by name is only done
 * as a last resort, and only if the referenced element supports the name
 * attribute.
 *
 * @return Element|null
 */
public function namedItem(string $name) {
	$namedElement = null;

// ENHANCEMENT: Iterating all elements is costly. Room for improvement here?
	foreach($this as $element) {
		if($element->getAttribute("id") === $name) {
			return $element;
		}

		if(is_null($namedElement)
		&& $element->getAttribute("name") === $name) {
			$namedElement = $element;
		}
	}

	return $namedElement;
}

/**
 * Returns the number of Elements contained in this Collection. Exposed as the
 * $length property.
 *
 * @return int Number of Elements
 */
private function prop_get_length():int {
	$length = 0;
	foreach($this as $element) {
		$length++;
	}

	return $length;
}

public function count():int {
	return $this->length;
}

// Iterator implementation -----------------------------------------------------

public function current():Element {
	return $this->domNodeList[$this->key];
}

public function key():int {
	return $this->key;
}

public function next() {
	$this->key++;
	$this->incrementKeyToNextElement();
}

public function rewind() {
	$this->key = 0;
	$this->incrementKeyToNextElement();
}

public function valid():bool {
	return isset($this->domNodeList[$this->key]);
}

private function incrementKeyToNextElement() {
	while($this->valid()
	&& !$this->domNodeList[$this->key] instanceof Element) {
		$this->key++;
	}
}

/**
 * Offset exists?
 * @param integer $offset offset number
 * @return boolean
 */
public function offsetExists($offset):bool {
	return isset($offset, $this->domNodeList);
}

/**
 * Returns the element in the offset position
 * @param integer $offset offset number
 * @return phpgt\dom\Element
 */
public function offsetGet($offset):Element {
	return $this->item($offset);
}

public function offsetSet($offset, $value) {
	return $this->offsetUnset($offset);
}

public function offsetUnset($offset) {
	throw new \BadMethodCallException("HTMLCollection's items are read only");
}
}#