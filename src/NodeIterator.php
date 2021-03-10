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
 * @implements Iterator<int, Node>
 */
class NodeIterator implements Iterator {
	use MagicProp;

	private Node $pCurrentNode;
	private NodeFilter $pFilter;
	private int $iteratorIndex;

	protected function __construct(
		private Node $pRoot,
		private int $pWhatToShow = NodeFilter::SHOW_ALL,
		NodeFilter|callable $filter = null
	) {
		$this->pCurrentNode = $pRoot;
		$this->iteratorIndex = 0;

		if(!$filter) {
			$filter = function(Node $node):int {
				$show = $this->whatToShow;
				if($show === NodeFilter::SHOW_ALL) {
					return NodeFilter::FILTER_ACCEPT;
				}

				$return = NodeFilter::FILTER_ACCEPT;
				if($show & NodeFilter::SHOW_ELEMENT) {
					if(!$node instanceof Element) {
						$return = NodeFilter::FILTER_REJECT;
					}
				}
				if($show & NodeFilter::SHOW_ATTRIBUTE) {
					if(!$node instanceof Attr) {
						$return = NodeFilter::FILTER_REJECT;
					}
				}
				if($show & NodeFilter::SHOW_TEXT) {
					if(!$node instanceof Text) {
						$return = NodeFilter::FILTER_REJECT;
					}
				}
				if($show & NodeFilter::SHOW_PROCESSING_INSTRUCTION) {
					if(!$node instanceof ProcessingInstruction) {
						$return = NodeFilter::FILTER_REJECT;
					}
				}
				if($show & NodeFilter::SHOW_COMMENT) {
					if(!$node instanceof Comment) {
						$return = NodeFilter::FILTER_REJECT;
					}
				}
				if($show & NodeFilter::SHOW_DOCUMENT) {
					if(!$node instanceof Document) {
						$return = NodeFilter::FILTER_REJECT;
					}
				}
				if($show & NodeFilter::SHOW_DOCUMENT_TYPE) {
					if(!$node instanceof DocumentType) {
						$return = NodeFilter::FILTER_REJECT;
					}
				}
				if($show & NodeFilter::SHOW_DOCUMENT_FRAGMENT) {
					if(!$node instanceof DocumentFragment) {
						$return = NodeFilter::FILTER_REJECT;
					}
				}

				return $return;
			};
		}

		if(is_callable($filter)) {
			$filter = new class($filter) extends NodeFilter {
				/** @var callable */
				private $callback;

				public function __construct(callable $callback) {
					$this->callback = $callback;
				}

				public function acceptNode(Node $node):int {
					return call_user_func(
						$this->callback,
						$node
					);
				}
			};
		}

		/** @var NodeFilter $filter */
		$this->pFilter = $filter;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NodeIterator/root */
	protected function __prop_get_root():Node {
		return $this->pRoot;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NodeIterator/whatToShow */
	protected function __prop_get_whatToShow():int {
		return $this->pWhatToShow;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NodeIterator/filter */
	protected function __prop_get_filter():NodeFilter {
		return $this->pFilter;
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
