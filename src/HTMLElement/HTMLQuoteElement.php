<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLQuoteElement interface provides special properties and methods
 * (beyond the regular HTMLElement interface it also has available to it by
 * inheritance) for manipulating quoting elements, like <blockquote> and <q>,
 * but not the <cite> element.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLQuoteElement
 *
 * @property string $cite Is a DOMString reflecting the cite HTML attribute, containing a URL for the source of the quotation.
 */
class HTMLQuoteElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLQuoteElement/cite */
	protected function __prop_get_cite():string {
		return $this->getAttribute("cite") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLQuoteElement/cite */
	protected function __prop_set_cite(string $value):void {
		$this->setAttribute("cite", $value);
	}
}
