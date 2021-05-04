<?php
namespace Gt\Dom;

use DOMNode;

/**
 * The ChildNode mixin contains methods and properties that are common to all
 * types of Node objects that can have a parent. It's implemented by Element,
 * DocumentType, and CharacterData objects.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode
 */
trait ChildNode {
	/**
	 * Removes the object from the tree it belongs to.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/remove
	 */
	public function remove():void {
		if($parentNode = $this->parentNode) {
			$parentNode->removeChild($this);
		}
	}

	/**
	 * The ChildNode.before() method inserts a set of Node or DOMString
	 * objects in the children list of this ChildNode's parent, just before
	 * this ChildNode. DOMString objects are inserted as equivalent Text
	 * nodes.
	 *
	 * @param string|Node ...$nodes A set of Node or DOMString objects to
	 * insert.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/before
	 */
	public function before(string|Node...$nodes) {
		/** @var Node $child */
		$child = $this;

		if($parentNode = $this->parentNode) {
			/** @var Node $parentNode */
			foreach($nodes as $node) {
				if(is_string($node)) {
					$node = $this->ownerDocument->createTextNode($node);
				}
				$parentNode->insertBefore($node, $child);
			}
		}
	}

	/**
	 * The ChildNode.after() method inserts a set of Node or DOMString
	 * objects in the children list of this ChildNode's parent, just after
	 * this ChildNode. DOMString objects are inserted as equivalent Text
	 * nodes.
	 *
	 * @param string|Node ...$nodes A set of Node or DOMString objects to
	 * insert.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/after
	 */
	public function after(string|Node...$nodes) {
		/** @var Node $child */
		$child = $this;

		if($parentNode = $this->parentNode) {
			/** @var Node $parentNode */
			foreach($nodes as $node) {
				if(is_string($node)) {
					$node = $this->ownerDocument->createTextNode($node);
				}
				$parentNode->insertBefore($node, $child->nextSibling);
			}
		}
	}

	/**
	 * The ChildNode.replaceWith() method replaces this ChildNode in the
	 * children list of its parent with a set of Node or DOMString objects.
	 * DOMString objects are inserted as equivalent Text nodes.
	 *
	 * @param string|Node ...$nodes A set of Node or DOMString objects to
	 * replace.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/replaceWith
	 */
	public function replaceWith(string|Node...$nodes) {

	}
}
