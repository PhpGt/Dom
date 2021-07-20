<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLOListElement interface provides special properties (beyond those
 * defined on the regular HTMLElement interface it also has available to it by
 * inheritance) for manipulating ordered list elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOListElement
 *
 * @property bool $reversed Is a Boolean value reflecting the reversed and defining if the numbering is descending, that is its value is true, or ascending (false).
 * @property int $start Is a long value reflecting the start and defining the value of the first number of the first element of the list.
 * @property string $type Is a DOMString value reflecting the type and defining the kind of marker to be used to display.
 */
class HTMLOListElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOListElement/reversed */
	protected function __prop_get_reversed():bool {
		return $this->hasAttribute("reversed");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOListElement/reversed */
	protected function __prop_set_reversed(bool $value):void {
		if($value) {
			$this->setAttribute("reversed", "");
		}
		else {
			$this->removeAttribute("reversed");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOListElement/start */
	protected function __prop_get_start():int {
		if($this->hasAttribute("start")) {
			return (int)$this->getAttribute("start");
		}

		return 1;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOListElement/start */
	protected function __prop_set_start(int $value):void {
		$this->setAttribute("start", (string)$value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOListElement/type */
	protected function __prop_get_type():string {
		return $this->getAttribute("type") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOListElement/type */
	protected function __prop_set_type(string $value):void {
		$this->setAttribute("type", $value);
	}
}
