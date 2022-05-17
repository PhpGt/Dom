<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\ElementType;
use Gt\Dom\Exception\InvalidElementTypeException;

trait HTMLElement {
	use HTMLInputElement;
	use HTMLSelectElement;
	use HTMLOptionElement;

	protected function checkElementType(ElementType...$allowedTypes):void {
		if(!in_array($this->elementType, $allowedTypes)) {
			throw new InvalidElementTypeException("The requested function/property is not available on the current Element type of " . $this->elementType->name);
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/value */
	protected function __prop_get_value():string {
		if($value = $this->getAttribute("value")) {
			return $value;
		}

		return $this->textContent;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/value */
	protected function __prop_set_value(string $value):void {
		$this->setAttribute("value", $value);
	}
}
