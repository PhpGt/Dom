<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLModElement interface provides special properties (beyond the regular
 * methods and properties available through the HTMLElement interface they also
 * have available to them by inheritance) for manipulating modification
 * elements, that is <del> and <ins>.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLModElement
 *
 * @property string $cite Is a DOMString reflecting the cite HTML attribute, containing a URI of a resource explaining the change.
 * @property string $dateTime Is a DOMString reflecting the datetime HTML attribute, containing a date-and-time string representing a timestamp for the change.
 */
class HTMLModElement extends HTMLElement {
	/** https://developer.mozilla.org/en-US/docs/Web/API/HTMLModElement/cite */
	public function __prop_get_cite():string {
		return $this->getAttribute("cite") ?? "";
	}

	/** https://developer.mozilla.org/en-US/docs/Web/API/HTMLModElement/cite */
	public function __prop_set_cite(string $value):void {
		$this->setAttribute("cite", $value);
	}

	/** https://developer.mozilla.org/en-US/docs/Web/API/HTMLModElement/dateTime */
	public function __prop_get_dateTime():string {

	}

	/** https://developer.mozilla.org/en-US/docs/Web/API/HTMLModElement/dateTime */
	public function __prop_set_dateTime(string $value):void {

	}
}
