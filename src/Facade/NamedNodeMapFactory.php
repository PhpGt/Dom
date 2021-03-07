<?php
namespace Gt\Dom\Facade;

use Gt\Dom\Element;
use Gt\Dom\NamedNodeMap;

class NamedNodeMapFactory extends NamedNodeMap {
	/** @param callable $callback Returns DOMNamedNodeMap */
	public static function create(
		callable $callback,
		Element $owner
	):NamedNodeMap {
		return new NamedNodeMap($callback, $owner);
	}
}
