<?php
namespace Gt\Dom;

class DOMTokenListFactory extends DOMTokenList {
	public static function create(
		callable $accessCallback,
		callable $mutateCallback
	):DOMTokenList {
		return new DOMTokenList($accessCallback, $mutateCallback);
	}
}
