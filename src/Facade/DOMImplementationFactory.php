<?php
namespace Gt\Dom\Facade;

use Gt\Dom\DocumentType;
use Gt\Dom\DOMImplementation;

class DOMImplementationFactory extends DOMImplementation {
	public static function create(DocumentType $doctype):DOMImplementation {
		return new DOMImplementation($doctype);
	}
}
