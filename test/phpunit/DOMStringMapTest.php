<?php
namespace Gt\Dom\Test;

use Gt\Dom\DOMStringMap;
use PHPUnit\Framework\TestCase;

class DOMStringMapTest extends TestCase {
	public function test():void {
		$keyValuePairs = [];
		$getter = function() use (&$keyValuePairs) {
			return $keyValuePairs;
		};
		$setter = function(array $kvp) use (&$keyValuePairs) {
			$keyValuePairs = $kvp;
		};
		$sut = new DOMStringMap($getter, $setter);
		$sut->example = "example123";
		self::assertNotNull($sut->example);
		self::assertSame($keyValuePairs["example"], $sut->example);

	}
}
