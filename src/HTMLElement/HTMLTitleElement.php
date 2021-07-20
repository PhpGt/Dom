<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLTitleElement interface contains the title for a document. This
 * element inherits all of the properties and methods of the HTMLElement
 * interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTitleElement
 *
 * @property string $text Is a DOMString representing the text of the document's title.
 */
class HTMLTitleElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTitleElement/text */
	protected function __prop_get_text():string {
		return $this->innerText;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTitleElement/text */
	protected function __prop_set_text(string $value):void {
		$this->innerText = $value;
	}
}
