<?php
namespace Gt\Dom;

use ArrayAccess;
use Countable;
use Iterator;

class NodeList implements ArrayAccess, Countable, Iterator {
// ArrayAccess functions:
	public function offsetExists(mixed $offset):bool {
		// TODO: Implement offsetExists() method.
	}

	public function offsetGet(mixed $offset):mixed {
		// TODO: Implement offsetGet() method.
	}

	public function offsetSet(mixed $offset, mixed $value):void {
		// TODO: Implement offsetSet() method.
	}

	public function offsetUnset(mixed $offset):void {
		// TODO: Implement offsetUnset() method.
	}
// End ArrayAccess functions.

// Countable functions:
	public function count():int {
		// TODO: Implement count() method.
	}
// End Countable functions.

// Iterator functions:
	public function current():mixed {
		// TODO: Implement current() method.
	}

	public function next():void {
		// TODO: Implement next() method.
	}

	public function key():mixed {
		// TODO: Implement key() method.
	}

	public function valid():bool {
		// TODO: Implement valid() method.
	}

	public function rewind():void {
		// TODO: Implement rewind() method.
	}
// End Iterator functions.
}
