<?php
namespace Gt\Dom\HTMLElement;

/**
 * This is a non-standard trait that contains functions and properties that are
 * shared between any UI elements, such as buttons, inputs, selects, etc.
 *
 * @property bool $autofocus Is a Boolean indicating whether or not the control should have input focus when the page loads, unless the user overrides it, for example by typing in a different control. Only one form-associated element in a document can have this attribute specified.
 * @property bool $disabled Is a Boolean indicating whether or not the control is disabled, meaning that it does not accept any clicks.
 * @property-read HTMLFormElement $form Is a HTMLFormElement reflecting the form that this element is associated with.
 * @property string $formAction Is a DOMString reflecting the URI of a resource that processes information submitted by the HTMLUIElement. If specified, this attribute overrides the action attribute of the <form> element that owns this element.
 * @property string $formEncType Is a DOMString reflecting the type of content that is used to submit the form to the server. If specified, this attribute overrides the enctype attribute of the <form> element that owns this element.
 * @property string $formMethod Is a DOMString reflecting the HTTP method that the browser uses to submit the form. If specified, this attribute overrides the method attribute of the <form> element that owns this element.
 * @property bool $formNoValidate Is a Boolean indicating that the form is not to be validated when it is submitted. If specified, this attribute overrides the novalidate attribute of the <form> element that owns this element.
 * @property string $formTarget Is a DOMString reflecting a name or keyword indicating where to display the response that is received after submitting the form. If specified, this attribute overrides the target attribute of the <form> element that owns this element.
 * @property-read NodeList $labels Is a NodeList that represents a list of <label> elements that are labels for this HTMLUIElement.
 * @property string $name Is a DOMString representing the name of the object when submitted with a form. If specified, it must not be the empty string.
 * @property-read bool $willValidate Is a Boolean indicating whether the button is a candidate for constraint validation. It is false if any conditions bar it from constraint validation, including: its type property is reset or button; it has a <datalist> ancestor; or the disabled property is set to true.
 * @property-read string $validationMessage Is a DOMString representing the localized message that describes the validation constraints that the control does not satisfy (if any). This attribute is the empty string if the control is not a candidate for constraint validation (willValidate is false), or it satisfies its constraints.
 * @property-read string $validity Is a ValidityState representing the validity states that this button is in.
 * @property string $value Is a DOMString representing the current form control value of the HTMLUIElement.
 */
trait HTMLUIElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/autofocus */
	protected function __prop_get_autofocus():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/autofocus */
	protected function __prop_set_autofocus(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/disabled */
	protected function __prop_get_disabled():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/disabled */
	protected function __prop_set_disabled(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/form */
	protected function __prop_get_form():HTMLFormElement {

	}

	protected function __prop_get_formAction():string {

	}

	protected function __prop_set_formAction(string $value):void {

	}

	protected function __prop_get_formEncType():string {

	}

	protected function __prop_set_formEncType(string $value):void {

	}

	protected function __prop_get_formMethod():string {

	}

	protected function __prop_set_formMethod(string $value):void {

	}

	protected function __prop_get_formNoValidate():bool {

	}

	protected function __prop_set_formNoValidate(bool $value):void {

	}

	protected function __prop_get_formTarget():string {

	}

	protected function __prop_set_formTarget(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/labels */
	protected function __prop_get_labels():NodeList {

	}

	protected function __prop_get_name():string {

	}

	protected function __prop_set_name(string $value):void {

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
