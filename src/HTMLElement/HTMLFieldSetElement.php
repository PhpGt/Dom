<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\HTMLCollection;

/**
 * The HTMLFieldSetElement interface provides special properties and methods
 * (beyond the regular HTMLElement interface it also has available to it by
 * inheritance) for manipulating the layout and presentation of <fieldset>
 * elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFieldSetElement
 *
 * @property-read HTMLCollection $elements The elements belonging to this field set.
 * @property-read string $type The DOMString "fieldset".
 */
class HTMLFieldSetElement extends HTMLElement {
	use HTMLUIElement;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFieldSetElement/elements */
	protected function __prop_get_elements():HTMLFormControlsCollection {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFieldSetElement/type */
	protected function __prop_get_type():string {
		return "fieldset";
	}
}
