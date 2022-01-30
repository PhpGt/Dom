<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\ClientSide\ValidityState;
use Gt\Dom\Facade\NodeListFactory;
use Gt\Dom\NodeList;

/**
 * This is a non-standard trait that contains functions and properties that are
 * shared between any UI elements, such as buttons, inputs, selects, etc.
 *
 * @property bool $autofocus Is a Boolean indicating whether or not the control should have input focus when the page loads, unless the user overrides it, for example by typing in a different control. Only one form-associated element in a document can have this attribute specified.
 * @property bool $disabled Is a Boolean indicating whether or not the control is disabled, meaning that it does not accept any clicks.
 * @property-read ?HTMLFormElement $form Is a HTMLFormElement reflecting the form that this element is associated with.
 * @property-read NodeList $labels Is a NodeList that represents a list of <label> elements that are labels for this HTMLUIElement.
 * @property string $name Is a DOMString representing the name of the object when submitted with a form. If specified, it must not be the empty string.
 * @property bool $readOnly Returns / Sets the element's readonly attribute, indicating that the user cannot modify the value of the control.
 * @property bool $required Returns / Sets the element's required attribute, indicating that the user must fill in a value before submitting a form.
 * @property string $type Is a DOMString indicating the behavior of the button.
 * @property-read bool $willValidate Is a Boolean indicating whether the button is a candidate for constraint validation. It is false if any conditions bar it from constraint validation, including: its type property is reset or button; it has a <datalist> ancestor; or the disabled property is set to true.
 * @property-read string $validationMessage Is a DOMString representing the localized message that describes the validation constraints that the control does not satisfy (if any). This attribute is the empty string if the control is not a candidate for constraint validation (willValidate is false), or it satisfies its constraints.
 * @property-read ValidityState $validity Is a ValidityState representing the validity states that this button is in.
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

//	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/labels */
//	protected function __prop_get_labels():NodeList {
//		return NodeListFactory::createLive(function():array {
//			$labelsArray = [];
//			foreach($this->ownerDocument->getElementsByTagName("label") as $label) {
//				/** @var HTMLLabelElement $label */
//				if($label->htmlFor === $this->id) {
//					array_push($labelsArray, $label);
//				}
//			}
//
//			return $labelsArray;
//		});
//	}

	protected function __prop_get_name():string {
		return $this->getAttribute("name") ?? "";
	}

	protected function __prop_set_name(string $value):void {
		$this->setAttribute("name", $value);
	}

	protected function __prop_get_readOnly():bool {
		return $this->hasAttribute("readonly");
	}

	protected function __prop_set_readOnly(bool $value):void {
		if($value) {
			$this->setAttribute("readonly", "");
		}
		else {
			$this->removeAttribute("readonly");
		}
	}

	protected function __prop_get_required():bool {
		return $this->hasAttribute("required");
	}

	protected function __prop_set_required(bool $value):void {
		if($value) {
			$this->setAttribute("required", "");
		}
		else {
			$this->removeAttribute("required");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLButtonElement/type */
	protected function __prop_get_type():string {
		return $this->getAttribute("type") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLButtonElement/type */
	protected function __prop_set_type(string $value):void {
		$this->setAttribute("type", $value);
	}

	protected function __prop_get_willValidate():bool {
		if($this instanceof HTMLButtonElement) {
			return false;
		}

		if($this->disabled) {
			return false;
		}

		if(in_array($this->type, ["hidden", "reset", "button"])) {
			return false;
		}

		$context = $this;
		while($context->parentElement) {
			$context = $context->parentElement;
			if($context instanceof HTMLDataListElement) {
				return false;
			}
		}

		return true;
	}

	protected function __prop_get_validationMessage():string {
		return "";
	}

	protected function __prop_get_validity():ValidityState {
		return new ValidityState();
	}

	protected function __prop_get_value():string {
		$value = $this->getAttribute("value");
		if(!is_null($value)) {
			return $value;
		}

		if($this instanceof HTMLSelectElement) {
			if($this->selectedIndex === -1) {
				return "";
			}

			return $this->options[$this->selectedIndex]->value;
		}

		return $this->textContent;
	}

	protected function __prop_set_value(string $value):void {
		if($this instanceof HTMLSelectElement) {
			/** @var HTMLOptionElement $option */
			foreach($this->options as $option) {
				$option->selected = ($option->value === $value);
			}
			return;
		}

		$this->setAttribute("value", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-labels */
	protected function __prop_get_labels():NodeList {
		$input = $this;
		return NodeListFactory::createLive(function() use($input) {
			$labelsArray = [];

			$context = $input;
			while($context = $context->parentElement) {
				if($context instanceof HTMLLabelElement) {
					array_push($labelsArray, $context);
					break;
				}
			}

			if($id = $input->id) {
				foreach($input->ownerDocument->querySelectorAll("label[for='$id']") as $label) {
					array_push($labelsArray, $label);
				}
			}

			return $labelsArray;
		});
	}
}
