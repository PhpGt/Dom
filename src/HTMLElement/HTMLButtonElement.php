<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLButtonElement interface provides properties and methods (beyond the regular HTMLElement interface it also has
 * available to it by inheritance) for manipulating <button> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLButtonElement
 *
 * @property string $type Is a DOMString indicating the behavior of the button.
 */
class HTMLButtonElement extends HTMLElement {
	use HTMLUIElement;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLButtonElement/type */
	protected function __prop_get_type():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLButtonElement/type */
	protected function __prop_set_type(string $value):void {

	}
}
