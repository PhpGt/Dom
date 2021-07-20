<?php
namespace Gt\Dom\Facade;

use DOMNode;
use Gt\Dom\XPathResult;

class XPathResultFactory extends XPathResult {
	public static function create(
		string $query,
		DOMDocumentFacade $document,
		DOMNode $context = null
	):XPathResult {
		return new XPathResult($query, $document, $context);
	}
}
