<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLLegendElement is an interface allowing to access properties of the
 * <legend> elements. It inherits properties and methods from the HTMLElement
 * interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLLegendElement
 *
 * @property-read ?HTMLFormElement $form Is a HTMLFormElement representing the form that this legend belongs to. If the legend has a fieldset element as its parent, then this attribute returns the same value as the form attribute on the parent fieldset element. Otherwise, it returns null.
 */
class HTMLLegendElement extends HTMLElement {
	protected function __prop_get_form():?HTMLFormElement {

	}
}
