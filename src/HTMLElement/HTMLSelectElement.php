<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\ClientSide\ValidityState;
use Gt\Dom\HTMLCollection;
use Gt\Dom\NodeList;

/**
 * The HTMLSelectElement interface represents a <select> HTML Element. These
 * elements also share all of the properties and methods of other HTML elements
 * via the HTMLElement interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement
 *
 * @property-read int $length An unsigned long The number of <option> elements in this select element.
 * @property bool $multiple A Boolean reflecting the multiple HTML attribute, which indicates whether multiple items can be selected.
 * @property-read HTMLOptionsCollection $options An HTMLOptionsCollection representing the set of <option> (HTMLOptionElement) elements contained by this element.
 * @property int $selectedIndex A long reflecting the index of the first selected <option> element. The value -1 indicates no element is selected.
 * @property-read HTMLCollection $selectedOptions An HTMLCollection representing the set of <option> elements that are selected.
 * @property int $size A long reflecting the size HTML attribute, which contains the number of visible items in the control. The default is 1, unless multiple is true, in which case it is 4.
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
class HTMLSelectElement extends HTMLElement {
	use HTMLUIElement;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/length */
	protected function __prop_get_length():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/multiple */
	protected function __prop_get_multiple():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/multiple */
	protected function __prop_set_multiple(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/options */
	protected function __prop_get_options():HTMLOptionsCollection {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/selectedIndex */
	protected function __prop_get_selectedIndex():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/selectedIndex */
	protected function __prop_set_selectedIndex(int $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/selectedOptions */
	protected function __prop_get_selectedOptions():HTMLCollection {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/size */
	protected function __prop_get_size():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/size */
	protected function __prop_set_size(int $value):void {

	}
}
