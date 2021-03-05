<?php
namespace Gt\Dom\Facade;

use Gt\Dom\DOMTokenList;

class DOMTokenListFactory extends DOMTokenList {
	public static function create(
		callable $accessCallback,
		callable $mutateCallback
	):DOMTokenList {
		return new DOMTokenList($accessCallback, $mutateCallback);
	}
}
