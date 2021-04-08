<?php
namespace Gt\Dom\HTMLElement;

use ArrayAccess;
use Countable;
use Gt\Dom\Exception\ArrayAccessReadOnlyException;
use Gt\Dom\Facade\HTMLCollectionFactory;
use Gt\Dom\HTMLCollection;
use Gt\Dom\HTMLFormControlsCollection;

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
class HTMLFormElement extends HTMLElement implements ArrayAccess, Countable {
	public function offsetExists(mixed $offset):bool {
		$match = $this->elements->namedItem($offset);
		return !is_null($match);
	}

	public function offsetGet(mixed $offset):?HTMLElement {
		/** @var HTMLElement|null $element */
		$element = $this->elements->namedItem($offset);
		return $element;
	}

	public function offsetSet(mixed $offset, mixed $value):void {
		throw new ArrayAccessReadOnlyException();
	}

	public function offsetUnset(mixed $offset):void {
		throw new ArrayAccessReadOnlyException();
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/elements */
	protected function __prop_get_elements():HTMLFormControlsCollection {
		return HTMLCollectionFactory::createHTMLFormControlsCollection(
// List of elements taken from: https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/elements#value
			fn() => $this->querySelectorAll("button, fieldset, input, object, output, select, textarea")
		);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/length */
	protected function __prop_get_length():int {
		return count($this->elements);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/name */
	protected function __prop_get_name():string {
		return $this->getAttribute("name") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/name */
	protected function __prop_set_name(string $value):void {
		$this->setAttribute("name", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/method */
	protected function __prop_get_method():string {
		return $this->getAttribute("method") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/method */
	protected function __prop_set_method(string $value):void {
		$this->setAttribute("method", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/target */
	protected function __prop_get_target():string {
		return $this->getAttribute("target") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/target */
	protected function __prop_set_target(string $value):void {
		$this->setAttribute("target", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/action */
	protected function __prop_get_action():string {
		return $this->getAttribute("action") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/action */
	protected function __prop_set_action(string $value):void {
		$this->setAttribute("action", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/encoding */
	protected function __prop_get_encoding():string {
		return $this->getAttribute("enctype") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/encoding */
	protected function __prop_set_encoding(string $value):void {
		$this->setAttribute("enctype", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/enctype */
	protected function __prop_get_enctype():string {
		return $this->getAttribute("enctype") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/enctype */
	protected function __prop_set_enctype(string $value):void {
		$this->setAttribute("enctype", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/acceptCharset */
	protected function __prop_get_acceptCharset():string {
		return $this->getAttribute("accept-charset") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/acceptCharset */
	protected function __prop_set_acceptCharset(string $value):void {
		$this->setAttribute("accept-charset", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/autocomplete */
	protected function __prop_get_autocomplete():string {
		return $this->getAttribute("autocomplete") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/autocomplete */
	protected function __prop_set_autocomplete(string $value):void {
		$this->setAttribute("autocomplete", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/noValidate */
	protected function __prop_get_noValidate():bool {
		return $this->hasAttribute("novalidate");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/noValidate */
	protected function __prop_set_noValidate(bool $value):void {
		if($value) {
			$this->setAttribute("novalidate", "");
		}
		else {
			$this->removeAttribute("novalidate");
		}
	}

	public function count():int {
		return $this->length;
	}
}
