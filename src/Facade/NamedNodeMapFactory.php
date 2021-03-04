<?php
namespace Gt\Dom\Facade;

use DOMNamedNodeMap;
use Gt\Dom\Document;
use Gt\Dom\NamedNodeMap;

class NamedNodeMapFactory extends NamedNodeMap {
	/** @param callable $callback DOMNamedNodeMap */
	public static function create(
		callable $callback,
		Document $ownerDocument
	):NamedNodeMap {
		return new NamedNodeMap($callback, $ownerDocument);
	}
}
