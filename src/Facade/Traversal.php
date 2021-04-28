<?php
namespace Gt\Dom\Facade;

use Gt\Dom\Attr;
use Gt\Dom\Comment;
use Gt\Dom\Document;
use Gt\Dom\DocumentFragment;
use Gt\Dom\DocumentType;
use Gt\Dom\Element;
use Gt\Dom\Node;
use Gt\Dom\NodeFilter;
use Gt\Dom\ProcessingInstruction;
use Gt\Dom\Text;
use Gt\PropFunc\MagicProp;

trait Traversal {
	use MagicProp;

	private Node $pRoot;
	private int $pWhatToShow;
	private Node $pCurrentNode;
	private NodeFilter $pFilter;
	private int $iteratorIndex;
	private ?Node $validity;

	protected function __construct(
		Node $root,
		int $whatToShow = NodeFilter::SHOW_ALL,
		NodeFilter|callable $filter = null
	) {
		$this->pRoot = $root;
		$this->pWhatToShow = $whatToShow;
		$this->pCurrentNode = $root;

		$this->iteratorIndex = 0;
		$this->validity = null;

		if(!$filter) {
			$filter = function(Node $node):int {
				$show = $this->pWhatToShow;
				if($show === NodeFilter::SHOW_ALL) {
					return NodeFilter::FILTER_ACCEPT;
				}

				$matches = 0;
				if($show & NodeFilter::SHOW_ELEMENT) {
					$matches += $node instanceof Element;
				}
				if($show & NodeFilter::SHOW_ATTRIBUTE) {
					$matches += $node instanceof Attr;
				}
				if($show & NodeFilter::SHOW_TEXT) {
					$matches += $node instanceof Text;
				}
				if($show & NodeFilter::SHOW_PROCESSING_INSTRUCTION) {
					$matches += $node instanceof ProcessingInstruction;
				}
				if($show & NodeFilter::SHOW_COMMENT) {
					$matches += $node instanceof Comment;
				}
				if($show & NodeFilter::SHOW_DOCUMENT) {
					$matches += $node instanceof Document;
				}
				if($show & NodeFilter::SHOW_DOCUMENT_TYPE) {
					$matches += $node instanceof DocumentType;
				}
				if($show & NodeFilter::SHOW_DOCUMENT_FRAGMENT) {
					$matches += $node instanceof DocumentFragment;
				}

				return $matches > 0
					? NodeFilter::FILTER_ACCEPT
					: NodeFilter::FILTER_REJECT;
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

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/root */
	protected function __prop_get_root():Node {
		return $this->pRoot;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/whatToShow */
	protected function __prop_get_whatToShow():int {
		return $this->pWhatToShow;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/filter */
	protected function __prop_get_filter():NodeFilter {
		return $this->pFilter;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/TreeWalker/currentNode */
	protected function __prop_get_currentNode():Node {
		return $this->pCurrentNode;
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
		$node = $this->pCurrentNode;

		while($node && $node !== $this->pRoot) {
			$node = $node->parentNode;

			if($node && $this->filter->acceptNode($node) === NodeFilter::FILTER_ACCEPT) {
				$this->pCurrentNode = $node;
				return $node;
			}
		}

		return null;
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
		return $this->traverseChildren("first");
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
		return $this->traverseChildren("last");
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
		return $this->traverseSiblings("previous");
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
		return $this->traverseSiblings("next");
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
		$node = $this->pCurrentNode;

		while($node !== $this->pRoot) {
			$sibling = $node->previousSibling;

			while(!is_null($sibling)) {
				$node = $sibling;
				$result = $this->filter->acceptNode($node);

				while($result !== NodeFilter::FILTER_REJECT
					&& !is_null($node->lastChild)) {
					$node = $node->lastChild;
					$result = $this->filter->acceptNode($node);
				}
				if($result === NodeFilter::FILTER_ACCEPT) {
					/** @var Node $node */
					$this->pCurrentNode = $node;
					return $node;
				}

				$sibling = $node->previousSibling;
			}

// The referenced polyfill for this implementation includes an extra check to
// the parentNode here, but as far as I can tell, this logic never be hit.
// See: https://github.com/Krinkle/dom-TreeWalker-polyfill/blob/master/src/TreeWalker-polyfill.js#L336-L338

			$node = $node->parentNode;
			if($this->filter->acceptNode($node) === NodeFilter::FILTER_ACCEPT) {
				/** @var Node $node */
				$this->pCurrentNode = $node;
				return $node;
			}
		}

		return null;
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
		if($node = $this->getNextNode($this->pCurrentNode)) {
			/** @var Node $node */
			$this->pCurrentNode = $node;
			return $node;
		}

		return null;
	}

	private function getNextNode(Node $node):?Node {
		$result = NodeFilter::FILTER_ACCEPT;

		while(true) {
			do {
				if($node->firstChild) {
					$node = $node->firstChild;
				}
				else {
					continue;
				}

				$result = $this->filter->acceptNode($node);
				if($result === NodeFilter::FILTER_ACCEPT) {
					return $node;
				}
			}
			while($result === NodeFilter::FILTER_REJECT
			&& !is_null($node->firstChild));

			$following = $this->nextSkippingChildren($node, $this->pRoot);
			if(!is_null($following)) {
				$node = $following;
			}
			else {
				break;
			}

			$result = $this->filter->acceptNode($node);
			if($result === NodeFilter::FILTER_ACCEPT) {
				return $node;
			}
		}

		return null;
	}

	public function current():Node {
		return $this->currentNode;
	}

	public function next():void {
		$this->iteratorIndex++;
		$this->nextNode();
	}

	public function key():int {
		return $this->iteratorIndex;
	}

	public function valid():bool {
		$valid = $this->validity !== $this->pCurrentNode;
		$this->validity = $this->pCurrentNode;
		return $valid;
	}

	public function rewind():void {
		$this->iteratorIndex = 0;
		$this->pCurrentNode = $this->pRoot;
	}

	private function traverseChildren(string $direction):?Node {
		$node = $this->matchChild($this->pCurrentNode, $direction);

		while($node) {
			$result = $this->filter->acceptNode($node);
			if($result === NodeFilter::FILTER_ACCEPT) {
				$this->pCurrentNode = $node;
				return $node;
			}
			if($result === NodeFilter::FILTER_SKIP) {
				$child = $this->matchChild($node, $direction);
				if($child) {
					$node = $child;
					continue;
				}
			}

			while($node) {
				$sibling = $this->matchChild($node, $direction);
				if($sibling) {
					$node = $sibling;
					break;
				}

				$parent = $node->parentNode;
				if(is_null($parent)
					|| $parent === $this->pRoot
					|| $parent === $this->pCurrentNode) {
					return null;
				}
				else {
					$node = $parent;
				}
			}
		}

		return null;
	}

	private function traverseSiblings(string $direction):?Node {
		$node = $this->pCurrentNode;

		if($node === $this->pRoot) {
			return null;
		}
		while(true) {
			$sibling = $this->matchSibling(
				$node,
				$direction
			);
			while($sibling) {
				$node = $sibling;
				$result = $this->filter->acceptNode($node);
				if($result === NodeFilter::FILTER_ACCEPT) {
					$this->pCurrentNode = $node;
					return $node;
				}

				$sibling = $this->matchChild(
					$node,
					$direction
				);
				if($result === NodeFilter::FILTER_REJECT) {
					$sibling = $this->matchSibling(
						$node,
						$direction
					);
				}
			}

			$node = $node->parentNode;
			if(is_null($node)
				|| $node === $this->pRoot) {
				return null;
			}

			if($this->filter->acceptNode($node) === NodeFilter::FILTER_ACCEPT) {
				return null;
			}
		}
	}

	private function matchChild(Node $node, string $direction):?Node {
		return match($direction) {
			"first" => $node->firstChild,
			"last", "next", "previous" => $node->lastChild,
			default => null,
		};
	}

	private function matchSibling(Node $node, string $direction):?Node {
		return match($direction) {
			"next" => $node->nextSibling,
			"previous" => $node->previousSibling,
			default => null,
		};
	}

	private function nextSkippingChildren(
		Node $node,
		Node $stayWithin
	):?Node {
		if($node === $stayWithin) {
			return null;
		}
		if(!is_null($node->nextSibling)) {
			return $node->nextSibling;
		}

		while(!is_null($node->parentNode)) {
			$node = $node->parentNode;
			if($node === $stayWithin) {
				break;
			}
			if(!is_null($node->nextSibling)) {
				return $node->nextSibling;
			}
		}

		return null;
	}
}
