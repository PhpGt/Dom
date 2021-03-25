<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLBaseElement interface contains the base URI for a document. This
 * object inherits all of the properties and methods as described in the
 * HTMLElement interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLBaseElement
 *
 * @property string $href Is a DOMString that reflects the href HTML attribute, containing a base URL for relative URLs in the document.
 * @property string $target Is a DOMString that reflects the target HTML attribute, containing a default target browsing context or frame for elements that do not have a target reference specified.
 */
class HTMLBaseElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLBaseElement/href */
	protected function __prop_get_href():string {
		return $this->getAttribute("href") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLBaseElement/href */
	protected function __prop_set_href(string $value):void {
		$this->setAttribute("href", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLBaseElement/target */
	protected function __prop_get_target():string {
		return $this->getAttribute("target") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLBaseElement/target */
	protected function __prop_set_target(string $value):void {
		$this->setAttribute("target", $value);
	}
}
