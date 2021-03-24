<?php
namespace Gt\Dom\HTMLElement;

use Stringable;

/**
 * The HTMLAreaElement interface provides special properties and methods (beyond
 * those of the regular object HTMLElement interface it also has available to it
 * by inheritance) for manipulating the layout and presentation of <area>
 * elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement
 *
 * @property string $alt Is a DOMString that reflects the alt HTML attribute, containing alternative text for the element.
 * @property string $coords Is a DOMString that reflects the coords HTML attribute, containing coordinates to define the hot-spot region.
 * @property string $shape Is a DOMString that reflects the shape HTML attribute, indicating the shape of the hot-spot, limited to known values.
 */
class HTMLAreaElement extends HTMLElement implements Stringable {
	use HTMLAnchorOrAreaElement;

	protected function __prop_get_alt():string {
		return $this->getAttribute("alt") ?? "";
	}

	protected function __prop_set_alt(string $value):void {
		$this->setAttribute("alt", $value);
	}

	protected function __prop_get_coords():string {

	}

	protected function __prop_set_coords(string $value):void {

	}

	protected function __prop_get_shape():string {

	}

	protected function __prop_set_shape(string $value):void {

	}
}
