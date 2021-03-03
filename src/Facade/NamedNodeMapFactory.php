<?php
namespace Gt\Dom\Facade;

use DOMNamedNodeMap;
use Gt\Dom\Document;
use Gt\Dom\NamedNodeMap;

class NamedNodeMapFactory extends NamedNodeMap {
	public static function create(
		DOMNamedNodeMap $nativeNamedNodeMap,
		Document $document
	):NamedNodeMap {
		return new NamedNodeMap($nativeNamedNodeMap, $document);
	}
}
