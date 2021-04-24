<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLOptGroupElement interface provides special properties and methods
 * (beyond the regular HTMLElement object interface they also have available to
 * them by inheritance) for manipulating the layout and presentation of
 * <optgroup> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptGroupElement
 *
 * @property bool $disabled Is a boolean representing whether or not the whole list of children <option> is disabled (true) or not (false).
 * @property string $label Is a DOMString representing the label for the group.
 */
class HTMLOptGroupElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptGroupElement/disabled */
	protected function __prop_get_disabled():bool {
		return $this->hasAttribute("disabled");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptGroupElement/disabled */
	protected function __prop_set_disabled(bool $value):void {
		if($value) {
			$this->setAttribute("disabled", "");
		}
		else {
			$this->removeAttribute("disabled");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptGroupElement/label */
	protected function __prop_get_label():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptGroupElement/label */
	protected function __prop_set_label(string $value):void {

	}
}
