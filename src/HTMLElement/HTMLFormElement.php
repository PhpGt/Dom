<?php
namespace Gt\Dom\HTMLElement;

use ArrayAccess;

/**
 * The HTMLFormElement interface represents a <form> element in the DOM. It
 * allows access to—and, in some cases, modification of—aspects of the form, as
 * well as access to its component elements.
 *
 * PHP.Gt/Dom implementation: Named inputs are added to their owner form
 * instance as ArrayAccesssable values. For example, $form["age"] will return
 * the HTMLInputElement with the name of "age", or null if one does not exist.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement
 *
 * @property-read HTMLFormControlsCollection $elements A HTMLFormControlsCollection holding all form controls belonging to this form element.
 * @property-read int $length A long reflecting the number of controls in the form.
 * @property string $name A DOMString reflecting the value of the form's name HTML attribute, containing the name of the form.
 * @property string $method A DOMString reflecting the value of the form's method HTML attribute, indicating the HTTP method used to submit the form. Only specified values can be set.
 * @property string $target A DOMString reflecting the value of the form's target HTML attribute, indicating where to display the results received from submitting the form.
 * @property string $action A DOMString reflecting the value of the form's action HTML attribute, containing the URI of a program that processes the information submitted by the form.
 * @property string $encoding A DOMString reflecting the value of the form's enctype HTML attribute, indicating the type of content that is used to transmit the form to the server. Only specified values can be set. The two properties are synonyms.
 * @property string $enctype A DOMString reflecting the value of the form's enctype HTML attribute, indicating the type of content that is used to transmit the form to the server. Only specified values can be set. The two properties are synonyms.
 * @property string $acceptCharset A DOMString reflecting the value of the form's accept-charset HTML attribute, representing the character encoding that the server accepts.
 * @property string $autocomplete A DOMString reflecting the value of the form's autocomplete HTML attribute, indicating whether the controls in this form can have their values automatically populated by the browser.
 * @property bool $noValidate A Boolean reflecting the value of the form's novalidate HTML attribute, indicating whether the form should not be validated.
 */
class HTMLFormElement implements ArrayAccess {
	public function offsetExists($offset):bool  {
	}

	public function offsetGet($offset):?HTMLUIElement {
		// TODO: Implement offsetGet() method.
	}

	public function offsetSet($offset, $value) {
		// TODO: Implement offsetSet() method.
		// This must throw an exception.
	}

	public function offsetUnset($offset) {
		// TODO: Implement offsetUnset() method.
		// This must throw an exception
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/elements */
	protected function __prop_get_elements():HTMLFormControlsCollection {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/length */
	protected function __prop_get_length():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/name */
	protected function __prop_get_name():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/name */
	protected function __prop_set_name(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/method */
	protected function __prop_get_method():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/method */
	protected function __prop_set_method(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/target */
	protected function __prop_get_target():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/target */
	protected function __prop_set_target(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/action */
	protected function __prop_get_action():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/action */
	protected function __prop_set_action(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/encoding */
	protected function __prop_get_encoding():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/encoding */
	protected function __prop_set_encoding(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/enctype */
	protected function __prop_get_enctype():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/enctype */
	protected function __prop_set_enctype(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/acceptCharset */
	protected function __prop_get_acceptCharset():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/acceptCharset */
	protected function __prop_set_acceptCharset(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/autocomplete */
	protected function __prop_get_autocomplete():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/autocomplete */
	protected function __prop_set_autocomplete(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/noValidate */
	protected function __prop_get_noValidate():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/noValidate */
	protected function __prop_set_noValidate(bool $value):void {

	}
}
