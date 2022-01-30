<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLOptionElement interface represents <option> elements and inherits
 * all classes and methods of the HTMLElement interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement
 *
 * @property bool $defaultSelected Is a Boolean that contains the initial value of the selected HTML attribute, indicating whether the option is selected by default or not.
 * @property-read int $index Is a long representing the position of the option within the list of options it belongs to, in tree-order. If the option is not part of a list of options, like when it is part of the <datalist> element, the value is 0.
 * @property string $label Is a DOMString that reflects the value of the label HTML attribute, which provides a label for the option. If this attribute isn't specifically set, reading it returns the element's text content.
 * @property bool $selected Is a Boolean that indicates whether the option is currently selected.
 * @property string $text Is a DOMString that contains the text content of the element.
 */
class HTMLOptionElement extends HTMLElement {
	use HTMLUIElement;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/defaultSelected */
	protected function __prop_get_defaultSelected():bool {
		return $this->selected;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/defaultSelected */
	protected function __prop_set_defaultSelected(bool $value):void {
		$this->selected = $value;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/index */
	protected function __prop_get_index():int {
		$parent = $this->parentElement;
		if($parent && $parent instanceof HTMLSelectElement) {
			foreach($parent->children as $i => $childElement) {
				if($childElement === $this) {
					return $i;
				}
			}
		}

		return 0;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/label */
	protected function __prop_get_label():string {
		if($label = $this->getAttribute("label")) {
			return $label;
		}

		return $this->textContent;
	}

	protected function __prop_set_label(string $value):void {
		$this->setAttribute("label", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/selected */
	protected function __prop_get_selected():bool {
		return $this->hasAttribute("selected");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/selected */
	protected function __prop_set_selected(bool $value):void {
		if($value) {
			$context = $this;
			while($context = $context->parentElement) {
				if($context instanceof HTMLSelectElement
				&& !$context->multiple) {
					foreach($context->options as $option) {
						/** @var HTMLOptionElement $option */
						$option->removeAttribute("selected");
					}
				}
			}

			$this->setAttribute("selected", "");
		}
		else {
			$this->removeAttribute("selected");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/text */
	protected function __prop_get_text():string {
		return $this->textContent;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/text */
	protected function __prop_set_text(string $value):void {
		$this->textContent = $value;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/value */
	protected function __prop_get_value():string {
		$value = $this->getAttribute("value");
		if(!is_null($value)) {
			return $value;
		}

		return $this->textContent;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/value */
	protected function __prop_set_value(string $value):void {
		$this->setAttribute("value", $value);
	}
}
