<?php
namespace Gt\Dom;

use DOMNode;

/**
 * A Node is an interface from which a number of DOM types inherit, and allows
 * these various types to be treated (or tested) similarly
 *
 * @method Node appendChild(DOMNode $newnode)
 * @method Node cloneNode(bool $deep = false)
 * @method Node insertBefore(DOMNode $newnode, DOMNode $refnode = null)
 * @method Node removeChild(DOMNode $oldnode)
 * @method Node replaceChild(DOMNode $newnode, DOMNode $oldnode)
 *
 * @property-read Node $parentNode
 * @property-read Node $firstChild
 * @property-read Node $lastChild
 * @property-read Node $previousSibling
 * @property-read Node $nextSibling
 */
class Node extends DOMNode {
	use LiveProperty, NonDocumentTypeChildNode, ChildNode, ParentNode;

	protected function getRootDocument():DOMDocument {
		return $this->ownerDocument;
	}
}