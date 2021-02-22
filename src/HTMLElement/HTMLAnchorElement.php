<?php
namespace Gt\Dom\HTMLElement;

use Stringable;
use Gt\PropFunc\MagicProp;
use Gt\Dom\DOMTokenList;

/**
 * The HTMLAnchorElement interface represents hyperlink elements and provides
 * special properties and methods (beyond those of the regular HTMLElement
 * object interface that they inherit from) for manipulating the layout and
 * presentation of such elements. This interface corresponds to <a> element;
 * not to be confused with <link>, which is represented by HTMLLinkElement).
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement
 *
 * @property string $hreflang Is a DOMString that reflects the hreflang HTML attribute, indicating the language of the linked resource.
 * @property string $text Is a DOMString being a synonym for the Node.textContent property.
 * @property string $type Is a DOMString that reflects the type HTML attribute, indicating the MIME type of the linked resource.

 */
class HTMLAnchorElement extends HTMLElement implements Stringable {
	use MagicProp;
	use HTMLOrForeignElement;
	use HTMLAnchorOrAreaElement;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hreflang */
	protected function __prop_get_hreflang():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hreflang */
	protected function __prop_set_hreflang(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/text */
	protected function __prop_get_text():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/text */
	protected function __prop_set_text(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/type */
	protected function __prop_get_type():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/type */
	protected function __prop_set_type(string $value):void {

	}
}
