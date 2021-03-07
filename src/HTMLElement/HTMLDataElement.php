<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLDataElement interface provides special properties (beyond the regular
 * HTMLElement interface it also has available to it by inheritance) for
 * manipulating <data> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDataElement
 *
 * @property string $value Is a DOMString reflecting the value HTML attribute, containing a machine-readable form of the element's value.
 */
class HTMLDataElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDataElement/value */
	protected function __prop_get_value():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDataElement/value */
	protected function __prop_set_value(string $value):void {

	}
}
