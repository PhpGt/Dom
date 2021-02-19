<?php
namespace Gt\Dom;

/**
 * The DocumentType interface represents a Node containing a doctype.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/DocumentType
 *
 * @property-read string $name A DOMString, eg "html" for <!DOCTYPE HTML>.
 * @property-read string $publicId A DOMString, eg "-//W3C//DTD HTML 4.01//EN", empty string for HTML5.
 * @property-read string $systemId A DOMString, eg "http://www.w3.org/TR/html4/strict.dtd", empty string for HTML5.
 */
class DocumentType extends Node {
	use ChildNode;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/DocumentType/name */
	protected function __prop_get_name():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/DocumentType/publicId */
	protected function __prop_get_publicId():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/DocumentType/systemId */
	protected function __prop_get_systemId():string {

	}
}
