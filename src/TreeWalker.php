<?php
namespace Gt\Dom;

use Gt\PropFunc\MagicProp;

/**
 * The TreeWalker object represents the nodes of a document subtree and a
 * position within them.
 *
 * A TreeWalker can be created using the Document.createTreeWalker() method.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker
 *
 * @property-read Node $root Returns a Node representing the root node as specified when the TreeWalker was created.
 * @property-read int $whatToShow Returns an unsigned long being a bitmask made  of constants describing the types of Node that must be presented. Non-matching nodes are skipped, but their children may be included, if relevant. The possible values are NodeFilter.SHOW_* constants.
 * @property-read NodeFilter $filter Returns a NodeFilter used to select the relevant nodes.
 * @property-read Node $currentNode Is the Node on which the TreeWalker is currently pointing at.
 */
class TreeWalker {
	use MagicProp;

	private Node $pCurrent;
	private NodeFilter $pFilter;

	protected function __construct(
		private Node $root,
		private int $whatToShow = NodeFilter::SHOW_ALL,
		NodeFilter|callable $filter = null
	) {
		$this->pCurrent = $root;

		if($filter) {
			if(is_callable($filter)) {
				$filter = new class($filter) extends NodeFilter {
					/** @var callable */
					private $callback;

					/** @param callable $callback */
					public function __construct($callback) {
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
			$this->pFilter = $filter;
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/root */
	protected function __prop_get_root():Node {
		return $this->root;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/whatToShow */
	protected function __prop_get_whatToShow():int {
		return $this->whatToShow;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/filter */
	protected function __prop_get_filter():NodeFilter {
		return $this->pFilter;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/currentNode */
	protected function __prop_get_currentNode():Node {
		return $this->pCurrent;
	}

	/**
	 * The TreeWalker.parentNode() method moves the current Node to the
	 * first visible ancestor node in the document order, and returns the
	 * found node. If no such node exists, or if it is above the
	 * TreeWalker's root node, returns null and the current node is not
	 * changed.
	 *
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/parentNode
	 */
	public function parentNode():?Node {

	}

	/**
	 * The TreeWalker.firstChild() method moves the current Node to the
	 * first visible child of the current node, and returns the found child.
	 * It also moves the current node to this child. If no such child
	 * exists, returns null and the current node is not changed.
	 *
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/firstChild
	 */
	public function firstChild():?Node {

	}

	/**
	 * The TreeWalker.lastChild() method moves the current Node to the last
	 * visible child of the current node, and returns the found child. It
	 * also moves the current node to this child. If no such child exists,
	 * returns null and the current node is not changed.
	 *
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/lastChild
	 */
	public function lastChild():?Node {

	}

	/**
	 * The TreeWalker.previousSibling() method moves the current Node to
	 * its previous sibling, if any, and returns the found sibling. If
	 * there is no such node, return null and the current node is not
	 * changed.
	 *
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/previousSibling
	 */
	public function previousSibling():?Node {

	}

	/**
	 * The TreeWalker.nextSibling() method moves the current Node to its
	 * next sibling, if any, and returns the found sibling. If there is no
	 * such node, return null and the current node is not changed.
	 *
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/nextSibling
	 */
	public function nextSibling():?Node {

	}

	/**
	 * The TreeWalker.previousNode() method moves the current Node to the
	 * previous visible node in the document order, and returns the found
	 * node. It also moves the current node to this one. If no such node
	 * exists,or if it is before that the root node defined at the object
	 * construction, returns null and the current node is not changed.
	 *
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/previousNode
	 */
	public function previousNode():?Node {

	}

	/**
	 * The TreeWalker.nextNode() method moves the current Node to the next
	 * visible node in the document order, and returns the found node. It
	 * also moves the current node to this one. If no such node exists,
	 * returns null and the current node is not changed.
	 *
	 * @return ?Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/nextNode
	 */
	public function nextNode():?Node {

	}
}
