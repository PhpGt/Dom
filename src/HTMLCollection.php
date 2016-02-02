<?php
namespace phpgt\dom;

use Iterator;
use ArrayAccess;

/**
 * Represents a NodeList that can only contain Element nodes. Internally,
 * a DOMNodeList is used to store the association to
 */
class HTMLCollection implements Iterator, ArrayAccess {

// Iterator implementation /////////////////////////////////////////////////////

public function current():Element {

}

public function key():int {

}

public function next():void {

}

public function rewind():void {

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