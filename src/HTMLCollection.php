<?php
namespace phpgt\dom;

use Iterator;
use ArrayAccess;

/**
 * Represents a Node list that can only contain Element nodes. Internally,
 * a DOMNodeList is used to store the association to the original list of
 * Nodes. The Iterator interface is used to handle the selection of Nodes
 * that are Elements.
 */
class HTMLCollection implements Iterator, ArrayAccess {

private $domNodeList;
private $key = 0;

public function __construct(\DOMNodeList $domNodeList) {
	$this->domNodeList = $domNodeList;
}

/**
 * Gets the nth Element object in the internal DOMNodeList.
 *
 * @param int $index
 * @return Element
 */
public function item(int $index):Element {
	foreach ($this as $key => $element) {
		var_dump($key);
	}
	die();
}

// Iterator implementation /////////////////////////////////////////////////////

public function current():Element {

}

public function key():int {

}

public function next() {

}

public function rewind() {
	$this->key = 0;
}

public function valid():bool {

}

// ArrayAccess implementation //////////////////////////////////////////////////
public function offsetExists($offset):bool {

}

public function offsetGet($offset):Element {

}

public function offsetSet($offset, $value) {
	return $this->offsetUnset($offset);
}

public function offsetUnset($offset) {
	throw new \BadMethodCallException("HTMLCollection's items are read only");
}
}#