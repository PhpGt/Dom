<?php
namespace Gt\Dom;

use Gt\Dom\Facade\NodeClass\DOMAttrFacade;
use Gt\Dom\Facade\NodeClass\DOMElementFacade;

/**
 * The Attr interface represents one of a DOM element's attributes as an object.
 * In most DOM methods, you will directly retrieve the attribute as a string
 * (e.g., Element.getAttribute()), but certain functions (e.g.,
 * Element.getAttributeNode()) or means of iterating return Attr types.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/Attr
 *
 * @property-read string $name The attribute's name.
 * @property-read string $namespaceURI A DOMString representing the namespace URI of the attribute, or null if there is no namespace.
 * @property-read string $localName A DOMString representing the local part of the qualified name of the attribute.
 * @property-read string $prefix A DOMString representing the namespace prefix of the attribute, or null if no prefix is specified.
 * @property-read ?Element $ownerElement The element holding the attribute.
 * @property-read bool $specified This property always returns true. Originally, it returned true if the attribute was explicitly specified in the source code or by a script, and false if its value came from the default one defined in the document's DTD.
 * @property string $value The attribute's value.
 */
class Attr extends Node {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Attr/name */
	protected function __prop_get_name():string {
		return $this->domNode->localName;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Attr/namespaceURI */
	protected function __prop_get_namespaceURI():?string {
		/** @noinspection PhpUndefinedFieldInspection */
		return $this->domNode->namespaceURI;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Attr/localName */
	protected function __prop_get_localName():string {
		return $this->domNode->localName;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Attr/prefix */
	protected function __prop_get_prefix():string {
		return $this->domNode->prefix;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Attr/ownerElement */
	protected function __prop_get_ownerElement():?Element {
		/** @var DOMAttrFacade $nativeAttr */
		$nativeAttr = $this->domNode;
		/** @var ?DOMElementFacade $nativeOwnerElement */
		$nativeOwnerElement = $nativeAttr->ownerElement;
		if(!$nativeOwnerElement) {
			return null;
		}

		/** @var Element $gtElement */
		$gtElement = $this->ownerDocument->getGtDomNode($nativeOwnerElement);
		return $gtElement;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Attr/specified */
	protected function __prop_get_specified():bool {
		return true;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Attr/value */
	protected function __prop_get_value():string {
		/** @var DOMAttrFacade $nativeNode */
		$nativeNode = $this->domNode;
		return $nativeNode->value;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Attr/value */
	protected function __prop_set_value(string $value):void {
		/** @var DOMAttrFacade $nativeNode */
		$nativeNode = $this->domNode;
		$nativeNode->value = $value;
	}
}
