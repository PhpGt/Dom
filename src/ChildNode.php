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
 */
trait ChildNode {

/**
 * Removes this ChildNode from the children list of its parent.
 * @return void
 */
public function remove() {
	$this->parentNode->removeChild($this);
}

/**
 * Inserts a Node into the children list of this ChildNode's parent,
 * just before this ChildNode.
 * @param DOMNode $node
 * @return void
 */
public function before(DOMNode $node) {
	$this->parentNode->insertBefore($node, $this);
}

/**
 * Inserts a Node into the children list of this ChildNode's parent,
 * just after this ChildNode.
 * @param DOMNode $node
 * @return void
 */
public function after(DOMNode $node) {
	$this->parentNode->insertBefore($node, $this->nextSibling);
}

/**
 * Replace this ChildNode in the children list of its parent with the
 * supplied replacement node.
 * @param DOMNode $replacement
 * @return void
 */
public function replaceWith(DOMNode $replacement) {
	$this->parentNode->insertBefore($replacement, $this);
	$this->remove();
}

}#