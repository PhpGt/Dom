<?php
namespace Gt\Dom;

use Countable;
use Gt\PropFunc\MagicProp;

/**
 * NodeList objects are collections of nodes, usually returned by properties
 * such as Node.childNodes and methods such as document.querySelectorAll().
 *
 * Although NodeList is not an Array, it is possible to iterate over it with
 * forEach(). It can also be converted to a real Array using Array.from().
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/NodeList
 *
 * @property-read int $length The number of nodes in the NodeList.
 */
class NodeList implements Countable {
	use MagicProp;

	/** @var Node[] */
	private array $nodeList;
	/** @var callable():NodeList */
	private $callback;

	/**
	 * A NodeList can, confusingly, be both "live" OR "static" using the
	 * same class. To differentiate, PHP.Gt sets EITHER a $nodeList
	 * OR a $callback property. When a $nodeList is set, the list is deemed
	 * "static". When a $callback is set, the list is deemed "live" and
	 * behaves similarly to HTMLCollection (which is ALWAYS live).
	 * @see HTMLCollection
	 */
	protected function __construct(Node|callable...$representation) {
		if(isset($representation[0]) && is_callable($representation[0])) {
			$this->callback = $representation[0];
		}
		else {
			$this->nodeList = $representation;
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NodeList/length */
	protected function __prop_get_length():int {
		return count($this->nodeList);
	}

	/**
	 * Returns a node from a NodeList by index. This method doesn't throw
	 * exceptions as long as you provide arguments. A value of null is
	 * returned if the index is out of range, and a TypeError is thrown if
	 * no argument is provided.
	 *
	 * @param int $index
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NodeList/item
	 */
	public function item(int $index):?Node {
		return $this->nodeList[$index];
	}

	/**
	 * The NodeList.entries() method returns an iterator allowing to go
	 * through all key/value pairs contained in this object. The values are
	 * Node objects.
	 *
	 * @return iterable<Node>
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NodeList/entries
	 */
	public function entries():iterable {

	}

	/**
	 * The forEach() method of the NodeList interface calls the callback
	 * given in parameter once for each value pair in the list, in
	 * insertion order.
	 *
	 * @param callable $callback
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NodeList/forEach
	 */
	public function forEach(callable $callback):void {

	}

	/**
	 * The NodeList.keys() method returns an iterator allowing to go
	 * through all keys contained in this object. The keys are unsigned
	 * integer.
	 *
	 * @return iterable<int>
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NodeList/keys
	 */
	public function keys():iterable {

	}

	/**
	 * The NodeList.values() method returns an iterator allowing to go
	 * through all values contained in this object. The values are Node
	 * objects.
	 *
	 * @return iterable
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NodeList/values
	 */
	public function values():iterable {

	}

	public function count():int {
		if(isset($this->nodeList)) {
			return count($this->nodeList);
		}

		/** @var NodeList $staticNodeList */
		$staticNodeList = call_user_func($this->callback);
		return count($staticNodeList);
	}
}
