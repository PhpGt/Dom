<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\HTMLCollection;

/**
 * The HTMLMapElement interface provides special properties and methods (beyond
 * those of the regular object HTMLElement interface it also has available to it
 * by inheritance) for manipulating the layout and presentation of map elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMapElement
 *
 * @property string $name Is a DOMString representing the <map> element for referencing it other context. If the id attribute is set, this must have the same value; and it cannot be null or empty.
 * @property-read HTMLCollection $areas Is a live HTMLCollection representing the <area> elements associated to this <map>.
 */
class HTMLMapElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMapElement/name */
	protected function __prop_get_name():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMapElement/name */
	protected function __prop_set_name(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMapElement/areas */
	protected function __prop_get_areas():HTMLCollection {

	}
}
