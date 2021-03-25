<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\NodeList;

/**
 * This is a non-standard trait that contains functions and properties that are
 * shared between any UI elements, such as buttons, inputs, selects, etc.
 *
 * @property bool $autofocus Is a Boolean indicating whether or not the control should have input focus when the page loads, unless the user overrides it, for example by typing in a different control. Only one form-associated element in a document can have this attribute specified.
 * @property bool $disabled Is a Boolean indicating whether or not the control is disabled, meaning that it does not accept any clicks.
 * @property-read ?HTMLFormElement $form Is a HTMLFormElement reflecting the form that this element is associated with.
 * @property string $inputMode The inputmode global attribute is an enumerated attribute that hints at the type of data that might be entered by the user while editing the element or its contents.
 * @property-read NodeList $labels Is a NodeList that represents a list of <label> elements that are labels for this HTMLUIElement.
 * @property string $name Is a DOMString representing the name of the object when submitted with a form. If specified, it must not be the empty string.
 * @property bool $readOnly Returns / Sets the element's readonly attribute, indicating that the user cannot modify the value of the control.
 * @property bool $required Returns / Sets the element's required attribute, indicating that the user must fill in a value before submitting a form.
 * @property string $type Is a DOMString indicating the behavior of the button.
 * @property-read bool $willValidate Is a Boolean indicating whether the button is a candidate for constraint validation. It is false if any conditions bar it from constraint validation, including: its type property is reset or button; it has a <datalist> ancestor; or the disabled property is set to true.
 * @property-read string $validationMessage Is a DOMString representing the localized message that describes the validation constraints that the control does not satisfy (if any). This attribute is the empty string if the control is not a candidate for constraint validation (willValidate is false), or it satisfies its constraints.
 * @property-read string $validity Is a ValidityState representing the validity states that this button is in.
 * @property string $value Is a DOMString representing the current form control value of the HTMLUIElement.
 */
trait HTMLUIElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/autofocus */
	protected function __prop_get_autofocus():bool {
		return $this->hasAttribute("autofocus");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/autofocus */
	protected function __prop_set_autofocus(bool $value):void {
		if($value) {
			$this->setAttribute("autofocus", "");
		}
		else {
			$this->removeAttribute("autofocus");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/disabled */
	protected function __prop_get_disabled():bool {
		return $this->hasAttribute("disabled");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/disabled */
	protected function __prop_set_disabled(bool $value):void {
		if($value) {
			$this->setAttribute("disabled", "");
		}
		else {
			$this->removeAttribute("disabled");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/form */
	protected function __prop_get_form():?HTMLFormElement {
		$context = $this;
		while($context->parentElement) {
			$context = $context->parentElement;

			if($context instanceof HTMLFormElement) {
				return $context;
			}
		}

		return null;
	}

	protected function __prop_get_inputMode():string {

	}

	protected function __prop_set_inputMode(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/labels */
	protected function __prop_get_labels():NodeList {

	}

	protected function __prop_get_name():string {

	}

	protected function __prop_set_name(string $value):void {

	}

	protected function __prop_get_readOnly():bool {

	}

	protected function __prop_set_readOnly(bool $value):void {

	}

	protected function __prop_get_required():bool {

	}

	protected function __prop_set_required(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLButtonElement/type */
	protected function __prop_get_type():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLButtonElement/type */
	protected function __prop_set_type(string $value):void {

	}

	protected function __prop_get_willValidate():bool {

	}

	protected function __prop_get_validationMessage():string {

	}

	protected function __prop_get_validity():string {

	}

	protected function __prop_get_value():string {

	}

	protected function __prop_set_value(string $value):void {

	}
}
