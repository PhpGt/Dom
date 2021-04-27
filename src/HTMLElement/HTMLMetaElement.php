<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLMetaElement interface contains descriptive metadata about a document.
 * It inherits all of the properties and methods described in the HTMLElement
 * interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMetaElement
 *
 * @property string $content Gets or sets the value of meta-data property.
 * @property string $httpEquiv Gets or sets the name of an HTTP response header to define for a document.
 * @property string $name Gets or sets the name of a meta-data property to define for a document.
 */
class HTMLMetaElement extends HTMLElement {
	protected function __prop_get_content():string {
		return $this->getAttribute("content") ?? "";
	}

	protected function __prop_set_content(string $value):void {
		$this->setAttribute("content", $value);
	}

	protected function __prop_get_httpEquiv():string {

	}

	protected function __prop_set_httpEquiv(string $value):void {

	}

	protected function __prop_get_name():string {

	}

	protected function __prop_set_name(string $value):void {

	}
}
