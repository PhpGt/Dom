<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLTimeElement interface provides special properties (beyond the regular HTMLElement interface it also has available to it by inheritance) for manipulating <time> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTimeElement
 *
 * @property string $dateTime Is a DOMString that reflects the datetime HTML attribute, containing a machine-readable form of the element's date and time value.
 */
class HTMLTimeElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTimeElement/dateTime */
	protected function __prop_get_dateTime():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTimeElement/dateTime */
	protected function __prop_set_dateTime(string $value):void {

	}
}
