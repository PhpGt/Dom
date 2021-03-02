<?php
namespace Gt\Dom;

use Gt\PropFunc\MagicProp;
use Iterator;

/**
 * The NodeIterator interface represents an iterator over the members of a list
 * of the nodes in a subtree of the DOM. The nodes will be returned in document
 * order.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/NodeIterator
 *
 * @property-read Node $root Returns a Node representing the root node as specified when the NodeIterator was created.
 * @property-read int $whatToShow Returns an unsigned long being a bitmask made of constants describing the types of Node that must to be presented. Non-matching nodes are skipped, but their children may be included, if relevant. Value is a combination of any NodeFilter.SHOW_* constnat.
 * @property-read NodeFilter $filter Returns a NodeFilter used to select the relevant nodes.
 *
 * @implements Iterator<Node>
 */
class NodeIterator implements Iterator {
	use MagicProp;

	protected function __construct(
		Node $root,
		int $whatToShow = NodeFilter::SHOW_ALL,
		NodeFilter|callable $filter = null
	) {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NodeIterator/root */
	protected function __prop_get_root():Node {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NodeIterator/whatToShow */
	protected function __prop_get_whatToShow():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NodeIterator/filter */
	protected function __prop_get_filter():NodeFilter {

	}

	/**
	 * The NodeIterator.previousNode() method returns the previous node in
	 * the set represented by the NodeIterator and moves the position of
	 * the iterator backwards within the set.
	 *
	 * This method returns null when the current node is the first node in
	 * the set.
	 *
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NodeIterator/previousNode
	 */
	public function previousNode():?Node {

	}

	/**
	 * The NodeIterator.nextNode() method returns the next node in the set
	 * represented by the NodeIterator and advances the position of the
	 * iterator within the set.  The first call to nextNode() returns the
	 * first node in the set.
	 *
	 * This method returns null when there are no nodes left in the set.
	 *
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/NodeIterator/nextNode
	 */
	public function nextNode():?Node {

	}

	public function current() {
		// TODO: Implement current() method.
	}

	public function next() {
		// TODO: Implement next() method.
	}

	public function key() {
		// TODO: Implement key() method.
	}

	public function valid() {
		// TODO: Implement valid() method.
	}

	public function rewind() {
		// TODO: Implement rewind() method.
	}
}
