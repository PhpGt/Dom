<?php
namespace Gt\Dom;

use DOMNode;

/**
 * @property-read null|Element $nextElementSibling An Element, the element immediately following the given one in the tree, or null if there's no sibling node.
 * @property-read null|Node|Element $nextSibling Returns a Node representing the next node in the tree, or null if there isn't such node.
 * @property-read null|Node|Element $firstChild
 * @property-read null|Element $firstElementChild
 * @property-read null|Node|Element $lastChild
 * @property-read null|Element $lastElementChild
 * @property-read null|Node|Element $previousSibling Returns a Node representing the previous node in the tree, or null if there isn't such node.
 * @property-read null|Element $previousElementSibling Returns a Node representing the previous node in the tree, or null if there isn't such node.
 */
class Node extends DOMNode {
	use NonDocumentTypeChildNode;
	use ChildNode;
	use ParentNode;
	use ElementNode;
}
