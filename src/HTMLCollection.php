<?php
namespace Gt\Dom;

use DOMNodeList;

/**
 * Represents a Node list that can only contain Element nodes.
 *
 * @property-read int $length Number of Element nodes in this collection
 */
class HTMLCollection extends NodeList {
	use LiveProperty;

	/** @var Element[] */
	protected $list;
	protected $iteratorKey;

	/** @noinspection PhpMissingParentConstructorInspection */
	public function __construct(DOMNodeList $domNodeList) {
		$this->list = [];
		$this->rewind();

		for($i = 0, $n = $domNodeList->length; $i < $n; $i++) {
			$item = $domNodeList->item($i);

			if(!$item instanceof Element) {
				continue;
			}

			$this->list []= $item;
		}
	}

	/**
	 * Returns the number of Elements contained in this Collection.
	 * Exposed as the $length property.
	 * @return int Number of Elements
	 */
	protected function prop_get_length():int {
		return count($this->list);
	}

	/**
	 * @param string $name Returns the specific Node whose ID or, as a fallback,
	 * name matches the string specified by $name. Matching by name is only done
	 * as a last resort, and only if the referenced element supports the name
	 * attribute.
	 */
	public function namedItem(string $name):?Element {
		$namedElement = null;

// TODO: Use an XPath query here -- it's got to be less costly than iterating.
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
	 * Gets the nth Element object in the internal DOMNodeList.
	 * @param int $index
	 * @return Element|null
	 */
	public function item(int $index):?Element {
		return $this->list[$index] ?? null;
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

	public function current():?Element {
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
		throw new \BadMethodCallException("HTMLCollection's items are read only");
	}

	public function offsetUnset($offset):void {
		throw new \BadMethodCallException("HTMLCollection's items are read only");
	}

// Countable -------------------------------------------------------------------
	public function count():int {
		return $this->length;
	}
}