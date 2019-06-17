<?php
namespace Gt\Dom;

use DOMNode;

/**
 * Represents an attribute on an Element object.
 *
 * In most DOM methods, you will probably directly retrieve the attribute as a
 * string (e.g., Element::getAttribute()), but certain functions (e.g.,
 * Element::getAttributeNode()) or means of iterating give Attr types.
 *
 * @property-read Element $ownerElement
 * @property-read Element $parentNode
 * @property-read Node|Element|null $firstChild
 * @property-read Node|Element|null $lastChild
 * @property-read Node|Element|null $previousSibling
 * @property-read Node|Element|null $nextSibling
 * @property-read Document $ownerDocument
 *
 * @method Element appendChild(DOMNode $newnode)
 * @method Element cloneNode(bool $deep = false)
 * @method Element insertBefore(DOMNode $newnode, DOMNode $refnode = null)
 * @method Element removeChild(DOMNode $oldnode)
 * @method Element replaceChild(DOMNode $newnode, DOMNode $oldnode)
 */
class Attr extends \DOMAttr {
	public function remove():self {
		$this->ownerElement->removeAttributeNode($this);
		return $this;
	}
}