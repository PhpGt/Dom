<?php
namespace Gt\Dom\Facade;

use Gt\Dom\HTMLDocument;

class HTMLDocumentFactory extends HTMLDocument {
	public static function create(string $html):HTMLDocument {
		return new HTMLDocument($html);
	}
}
