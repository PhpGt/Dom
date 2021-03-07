<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLParamElement interface provides special properties (beyond those of
 * the regular HTMLElement object interface it inherits) for manipulating
 * <param> elements, representing a pair of a key and a value that acts as a
 * parameter for an <object> element.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLParamElement
 *
 * @property string $name Is a DOMString representing the name of the parameter. It reflects the name attribute.
 * @property string $value Is a DOMString representing the value associated to the parameter. It reflects the value attribute.
 */
class HTMLParamElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLParamElement/name */
	protected function __prop_get_name():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLParamElement/name */
	protected function __prop_set_name(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLParamElement/value */
	protected function __prop_get_value():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLParamElement/value */
	protected function __prop_set_value(string $value):void {

	}
}
