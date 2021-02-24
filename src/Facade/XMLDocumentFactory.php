<?php
namespace Gt\Dom\Facade;

use Gt\Dom\XMLDocument;

class XMLDocumentFactory extends XMLDocument {
	public static function create(string $xml):XMLDocument {
		return new XMLDocument($xml);
	}
}
