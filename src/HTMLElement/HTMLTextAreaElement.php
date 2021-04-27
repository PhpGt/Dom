<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\ClientSide\ValidityState;
use Gt\Dom\NodeList;

/**
 * The HTMLTextAreaElement interface provides special properties and methods for
 * manipulating the layout and presentation of <textarea> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTextAreaElement
 *
 * @property string $autocapitalize Returns / Sets the element's capitalization behavior for user input. Valid values are: none, off, characters, words, sentences.
 * @property int $cols Returns / Sets the element's cols attribute, indicating the visible width of the text area.
 * @property string $defaultValue Returns / Sets the control's default value, which behaves like the Node.textContent property.
 * @property int $maxLength Returns / Sets the element's maxlength attribute, indicating the maximum number of characters the user can enter. This constraint is evaluated only when the value changes.
 * @property int $minLength Returns / Sets the element's minlength attribute, indicating the minimum number of characters the user can enter. This constraint is evaluated only when the value changes.
 * @property int $rows Returns / Sets the element's rows attribute, indicating the number of visible text lines for the control.
 * @property string $wrap Returns / Sets the wrap HTML attribute, indicating how the control wraps text.
 *
 * Imported from HTMLUIElement:
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
class HTMLTextAreaElement extends HTMLElement {
	use HTMLUIElement;

	protected function __prop_get_autocapitalize():string {
		return $this->getAttribute("autocapitalize") ?? "";
	}

	protected function __prop_set_autocapitalize(string $value):void {
		$this->setAttribute("autocapitalize", $value);
	}

	protected function __prop_get_cols():int {
		if($this->hasAttribute("cols")) {
			return (int)$this->getAttribute("cols");
		}
		return 20;
	}

	protected function __prop_set_cols(int $value):void {
		$this->setAttribute("cols", (string)$value);
	}

	protected function __prop_get_defaultValue():string {
		return $this->value;
	}

	protected function __prop_set_defaultValue(string $value):void {
		$this->value = $value;
	}

	protected function __prop_get_maxLength():int {
		if($this->hasAttribute("maxlength")) {
			return (int)$this->getAttribute("maxlength");
		}
		return -1;
	}

	protected function __prop_set_maxLength(int $value):void {
		$this->setAttribute("maxlength", (string)$value);
	}

	protected function __prop_get_minLength():int {
		if($this->hasAttribute("minlength")) {
			return (int)$this->getAttribute("minlength");
		}
		return -1;
	}

	protected function __prop_set_minLength(int $value):void {
		$this->setAttribute("minlength", (string)$value);
	}

	protected function __prop_get_rows():int {

	}

	protected function __prop_set_rows(int $value):void {

	}

	protected function __prop_get_wrap():string {

	}

	protected function __prop_set_wrap(string $value):void {

	}
}
