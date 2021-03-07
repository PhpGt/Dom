<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\DOMTokenList;

/**
 * The HTMLOutputElement interface provides properties and methods (beyond
 * those inherited from HTMLElement) for manipulating the layout and
 * presentation of <output> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOutputElement
 *
 * @property string $defaultValue A DOMString representing the default value of the element, initially the empty string.
 * @property-read DOMTokenList $htmlFor A DOMTokenList reflecting the for HTML attribute, containing a list of IDs of other elements in the same document that contribute to (or otherwise affect) the calculated value.
 */
class HTMLOutputElement extends HTMLElement {
	use HTMLUIElement;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOutputElement/defaultValue */
	protected function __prop_get_defaultValue():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOutputElement/defaultValue */
	protected function __prop_set_defaultValue(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOutputElement/htmlFor */
	protected function __prop_get_htmlFor():DOMTokenList {

	}
}
