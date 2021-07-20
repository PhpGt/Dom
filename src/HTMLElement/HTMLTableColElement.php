<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLTableColElement interface provides special properties (beyond the
 * HTMLElement interface it also has available to it inheritance) for
 * manipulating single or grouped table column elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableColElement
 *
 * @property int $span Is an unsigned long that reflects the span HTML attribute, indicating the number of columns to apply this object's attributes to. Must be a positive integer.
 */
class HTMLTableColElement extends HTMLElement {
	protected function __prop_get_span():int {
		if($this->hasAttribute("span")) {
			return (int)$this->getAttribute("span");
		}

		return 1;
	}

	protected function __prop_set_span(int $value):void {
		$this->setAttribute("span", (string)$value);
	}
}
