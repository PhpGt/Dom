<?php
namespace Gt\Dom;

use DOMDocument;
use DOMNode;

/**
 * A Node is an interface from which a number of DOM types inherit, and allows
 * these various types to be treated (or tested) similarly
 *
 * @method Node|Element appendChild(DOMNode $newnode)
 * @method Node|Element cloneNode(bool $deep = false)
 * @method Node|Element insertBefore(DOMNode $newnode, DOMNode $refnode = null)
 * @method Node|Element removeChild(DOMNode $oldnode)
 * @method Node|Element replaceChild(DOMNode $newnode, DOMNode $oldnode)
 *
 * @property-read ?Node $parentNode
 * @property-read ?Node $firstChild
 * @property-read ?Node $lastChild
 * @property-read ?Node $previousSibling
 * @property-read ?Node $nextSibling
 */
class Node extends DOMNode {
	use LiveProperty, NonDocumentTypeChildNode, ChildNode, ParentNode;

	protected function getRootDocument():DOMDocument {
		return $this->ownerDocument;
	}
}