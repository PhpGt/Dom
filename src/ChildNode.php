<?php
namespace Gt\Dom;

use DOMNode;

/**
 * Contains methods that are particular to Node objects that can have a parent.
 *
 * This trait is used by the following classes:
 *  - Element
 *  - DocumentType
 *  - CharacterData
 *
 * @property-read Node|Element $parentNode
 */
trait ChildNode {
	/**
	 * Removes this ChildNode from the children list of its parent.
	 */
	public function remove():void {
		$this->parentNode->removeChild($this);
	}

	/**
	 * Inserts a Node into the children list of this ChildNode's parent,
	 * just before this ChildNode.
	 * @param DOMNode $node
	 */
	public function before(DOMNode $node):void {
		$this->parentNode->insertBefore($node, $this);
	}

	/**
	 * Inserts a Node into the children list of this ChildNode's parent,
	 * just after this ChildNode.
	 * @param DOMNode $node
	 */
	public function after(DOMNode $node):void {
		$this->parentNode->insertBefore($node, $this->nextSibling);
	}

	/**
	 * Replace this ChildNode in the children list of its parent with the
	 * supplied replacement node.
	 * @param DOMNode $replacement
	 */
	public function replaceWith(DOMNode $replacement):void {
		$this->parentNode->insertBefore($replacement, $this);
		$this->remove();
	}
}