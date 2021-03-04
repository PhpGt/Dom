<?php
namespace Gt\Dom\Facade;

use Gt\Dom\DOMTokenList;

class DOMTokenListFactory extends DOMTokenList {
	public static function create(callable $callback):DOMTokenList {
		return new DOMTokenList($callback);
	}
}
