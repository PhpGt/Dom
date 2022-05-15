<?php
namespace Gt\Dom;

use ArrayAccess;
use Countable;
use Gt\PropFunc\MagicProp;
use Iterator;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use JetBrains\PhpStorm\Internal\TentativeType;

/**
 * @property-read int $length
 */
class HTMLCollection implements ArrayAccess, Countable, Iterator {
	use MagicProp;

	/** @var callable */
	private $callback;
	private int $iteratorIndex;

	protected function __construct(callable $callback) {
		$this->callback = $callback;
		$this->iteratorIndex = 0;
	}

	public function __prop_get_length():int {
		return 0;
	}

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
// End of ArrayAccess functions.

// Countable functions:
	public function count():int {
		// TODO: Implement count() method.
	}
// End of Countable functions.

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
// End of Iterator functions.

	/**
	 * The HTMLCollection method item() returns the node located at the
	 * specified offset into the collection.
	 *
	 * @param int $index The position of the Node to be returned. Elements
	 * appear in an HTMLCollection in the same order in which they appear
	 * in the document's source.
	 * @return ?Element The Element at the specified index, or null if index
	 * is less than zero or greater than or equal to the length property.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCollection/item
	 */
	public function item(int $index):?Element {
		/** @var NodeList $nodeList */
		$nodeList = call_user_func($this->callback);
		$item = $nodeList->item($index);

		if($item instanceof Element) {
			return $item;
		}

		return null;
	}

	/**
	 * Returns the specific node whose ID or, as a fallback, name matches
	 * the string specified by name. Matching by name is only done as a last
	 * resort, only in HTML, and only if the referenced element supports the
	 * name attribute. Returns null if no node exists by the given name.
	 *
	 * An alternative to accessing collection[name] (which instead returns
	 * undefined when name does not exist). This is mostly useful for
	 * non-JavaScript DOM implementations.
	 *
	 * @param string $nameOrId
	 * @return Element|RadioNodeList|null
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCollection/namedItem
	 */
	public function namedItem(string $nameOrId):Element|RadioNodeList|null {
		$matches = [
			"id" => [],
			"name" => [],
		];

		foreach($matches as $attribute => $list) {
			foreach($this as $element) {
				if($element->getAttribute($attribute) === $nameOrId) {
					array_push($matches[$attribute], $element);
				}
			}
		}

		if(isset($matches["id"][0])) {
			return $matches["id"][0];
		}

		$count = count($matches["name"]);
		if($count === 0) {
			return null;
		}
		elseif($count === 1) {
			return $matches["name"][0];
		}
		else {
			return NodeListFactory::createRadioNodeList(
				fn() => $matches["name"]
			);
		}
	}
}
