<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLOptionElement interface represents <option> elements and inherits
 * all classes and methods of the HTMLElement interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement
 *
 * @property bool $defaultSelected Is a Boolean that contains the initial value of the selected HTML attribute, indicating whether the option is selected by default or not.
 * @property bool $disabled Is a Boolean representing the value of the disabled HTML attribute, which indicates that the option is unavailable to be selected. An option can also be disabled if it is a child of an <optgroup> element that is disabled.
 * @property-read HTMLFormElement $form Is a HTMLFormElement representing the same value as the form of the corresponding <select> element, if the option is a descendant of a <select> element, or null if none is found.
 * @property-read int $index Is a long representing the position of the option within the list of options it belongs to, in tree-order. If the option is not part of a list of options, like when it is part of the <datalist> element, the value is 0.
 * @property-read string $label Is a DOMString that reflects the value of the label HTML attribute, which provides a label for the option. If this attribute isn't specifically set, reading it returns the element's text content.
 * @property bool $selected Is a Boolean that indicates whether the option is currently selected.
 * @property string $text Is a DOMString that contains the text content of the element.
 * @property string $value Is a DOMString that reflects the value of the value HTML attribute, if it exists; otherwise reflects value of the Node.textContent property.
 */
class HTMLOptionElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/defaultSelected */
	protected function __prop_get_defaultSelected():bool {
		return $this->selected;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/defaultSelected */
	protected function __prop_set_defaultSelected(bool $value):void {
		$this->selected = $value;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/disabled */
	protected function __prop_get_disabled():bool {
		return $this->hasAttribute("disabled");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/disabled */
	protected function __prop_set_disabled(bool $value):void {
		if($value) {
			$this->setAttribute("disabled", "");
		}
		else {
			$this->removeAttribute("disabled");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/form */
	protected function __prop_get_form():HTMLFormElement {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/index */
	protected function __prop_get_index():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/label */
	protected function __prop_get_label():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/selected */
	protected function __prop_get_selected():bool {
		return $this->hasAttribute("selected");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/selected */
	protected function __prop_set_selected(bool $value):void {
		if($value) {
			$this->setAttribute("selected", "");
		}
		else {
			$this->removeAttribute("selected");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/text */
	protected function __prop_get_text():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/text */
	protected function __prop_set_text(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/value */
	protected function __prop_get_value():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOptionElement/value */
	protected function __prop_set_value(string $value):void {

	}
}
