<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\ClientSide\WindowProxy;
use Gt\Dom\Document;

/**
 * The HTMLObjectElement interface provides special properties and methods
 * (beyond those on the HTMLElement interface it also has available to it by
 * inheritance) for manipulating the layout and presentation of <object>
 * element, representing external resources.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement
 *
 * @property-read ?Document $contentDocument Returns a Document representing the active document of the object element's nested browsing context, if any; otherwise null.
 * @property-read ?WindowProxy $contentWindow Returns a WindowProxy representing the window proxy of the object element's nested browsing context, if any; otherwise null.
 * @property string $data Returns a DOMString that reflects the data HTML attribute, specifying the address of a resource's data.
 * @property-read ?HTMLFormElement $form Returns a HTMLFormElement representing the object element's form owner, or null if there isn't one.
 * @property string $height Returns a DOMString that reflects the height HTML attribute, specifying the displayed height of the resource in CSS pixels.
 * @property string $name Returns a DOMString that reflects the name HTML attribute, specifying the name of the browsing context.
 * @property string $type Is a DOMString that reflects the type HTML attribute, specifying the MIME type of the resource.
 * @property bool $typeMustMatch Is a Boolean that reflects the typemustmatch HTML attribute, indicating if the resource specified by data must only be played if it matches the type attribute.
 * @property string $useMap Is a DOMString that reflects the usemap HTML attribute, specifying a <map> element to use.
 * @property-read string $validationMessage Returns a DOMString representing a localized message that describes the validation constraints that the control does not satisfy (if any). This is the empty string if the control is not a candidate for constraint validation (willValidate is false), or it satisfies its constraints.
 * @property-read ValidityState $validity Returns a ValidityState with the validity states that this element is in.
 * @property string $width Is a DOMString that reflects the width HTML attribute, specifying the displayed width of the resource in CSS pixels.
 * @property-read bool $willValidate Returns a Boolean that indicates whether the element is a candidate for constraint validation. Always false for HTMLObjectElement objects.
 */
class HTMLObjectElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/contentDocument */
	protected function __prop_get_contentDocument():?Document {
		return null;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/contentWindow */
	protected function __prop_get_contentWindow():?WindowProxy {
		return null;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/data */
	protected function __prop_get_data():string {
		return $this->getAttribute("data") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/data */
	protected function __prop_set_data(string $value):void {
		$this->setAttribute("data", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/form */
	protected function __prop_get_form():?HTMLFormElement {
		$context = $this;

		while($context = $context->parentElement) {
			if($context instanceof HTMLFormElement) {
				return $context;
			}
		}

		return null;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/height */
	protected function __prop_get_height():string {
		return $this->getAttribute("height") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/height */
	protected function __prop_set_height(string $value):void {
		$this->setAttribute("height", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/name */
	protected function __prop_get_name():string {
		return $this->getAttribute("name") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/name */
	protected function __prop_set_name(string $value):void {
		$this->setAttribute("name", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/type */
	protected function __prop_get_type():string {
		return $this->getAttribute("type") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/type */
	protected function __prop_set_type(string $value):void {
		$this->setAttribute("type", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/typeMustMatch */
	protected function __prop_get_typeMustMatch():bool {
		return $this->hasAttribute("typemustmatch");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/typeMustMatch */
	protected function __prop_set_typeMustMatch(bool $value):void {
		if($value) {
			$this->setAttribute("typemustmatch", "");
		}
		else {
			$this->removeAttribute("typemustmatch");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/useMap */
	protected function __prop_get_useMap():string {
		return $this->getAttribute("usemap") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/useMap */
	protected function __prop_set_useMap(string $value):void {
		$this->setAttribute("usemap", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/validationMessage */
	protected function __prop_get_validationMessage():string {
		return "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/validity */
	protected function __prop_get_validity():ValidityState {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/width */
	protected function __prop_get_width():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLObjectElement/width */
	protected function __prop_set_width(string $value):void {

	}

	protected function __prop_get_willValidate():bool {

	}

}
