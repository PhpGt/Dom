<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLLIElement interface exposes specific properties and methods (beyond
 * those defined by regular HTMLElement interface it also has available to it by
 * inheritance) for manipulating list elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLIElement
 *
 * @property int $value Is a long indicating the ordinal position of the list element inside a given <ol>. It reflects the value attribute of the HTML <li> element, and can be smaller than 0. If the <li> element is not a child of an <ol> element, the property has no meaning.
 */
class HTMLLiElement extends HTMLElement {
	protected function __prop_get_value():int {

	}

	protected function __prop_set_value(int $value):void {

	}
}
