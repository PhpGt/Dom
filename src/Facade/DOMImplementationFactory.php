<?php
namespace Gt\Dom\Facade;

use Gt\Dom\Document;
use Gt\Dom\DOMImplementation;

class DOMImplementationFactory extends DOMImplementation {
	public static function create(Document $document):DOMImplementation {
		return new DOMImplementation($document);
	}
}
